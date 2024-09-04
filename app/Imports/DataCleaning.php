<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;

class DataCleaning
{
    protected $primaryKey;
    protected $secondaryKey;
    protected $thirdKey;
    protected $model;
    protected $excelColumns;
    protected $dbColumns;
    protected $validationRules;
    protected $validationMessages;
    protected $cleanedData;
    protected $newData;
    protected $duplicatedData;
    protected $failedData;

    public function __construct($primaryKey, $secondaryKey, $thirdKey, $model, $excelColumns, $dbColumns, $validationRules, $validationMessages)
    {
        $this->primaryKey = $primaryKey;
        $this->secondaryKey = $secondaryKey;
        $this->thirdKey = $thirdKey;
        $this->model = $model;
        $this->excelColumns = $excelColumns;
        $this->dbColumns = $dbColumns;
        $this->validationRules = $validationRules;
        $this->validationMessages = $validationMessages;
        $this->cleanedData = collect();
        $this->newData = collect();
        $this->duplicatedData = collect();
        $this->failedData = collect();
    }

    public function collection(Collection $rows)
    {
        //===============[1]================
        // Filter and map rows based on primary key
        $rows = $rows->map(function ($row) {
            return $row->only($this->excelColumns);
        })
        ->filter(function ($row) {
            return $this->isEmptyRow($row);
        });
        // }) ->filter(function ($row) {
        //     return !is_null($row[$this->primaryKey]) && $row[$this->primaryKey] !== '';
        // });

        $rows = $rows->map(function ($row) {
            $mappedRow = [];
            foreach ($this->excelColumns as $index => $excelColumn) {
                $dbColumn = $this->dbColumns[$index] ?? null;
                if ($dbColumn) {
                    $mappedRow[$dbColumn] = $dbColumn == $this->primaryKey ? (string) $row[$excelColumn] ?? null : $row[$excelColumn] ?? null;                            
                }                
            }
            return collect($mappedRow);
        });
        // dd($rows);
        //===============[1]================

        //===============[2]================
        // Group by primary key
        $groupedRows = $rows->groupBy($this->primaryKey);        

        // Remove duplicates within each group
        $dedupedGroupedRows = $groupedRows->map(function ($group) {
            return $group->unique(function ($item) {
                return implode('', $item->toArray());
            });
        });
        //===============[2]================     

        //===============[3]================
        $seenPrimaryKeys = [];
        $seenSecondaryKeys = [];
        $seenThirdKeys = [];
        $emailGroups = $dedupedGroupedRows->flatten(1)->groupBy($this->secondaryKey);
        $nimGroups = $dedupedGroupedRows->flatten(1)->groupBy($this->primaryKey);
        $thirdGroups = $dedupedGroupedRows->flatten(1)->groupBy($this->thirdKey);

        $dedupedGroupedRows->each(function ($group, $primaryKeyValue) use (&$seenPrimaryKeys, &$seenSecondaryKeys, &$seenThirdKeys, $emailGroups, $nimGroups, $thirdGroups) {
            // Validate each item in the group
            $validatedGroup = $group->map(function ($item) {
                $validator = Validator::make($item->toArray(), $this->validationRules, $this->validationMessages);
                return $this->addErrorMessages($item, $validator);
            });

            $isDuplicate = false;
            $duplicateMessage = '';

            if (in_array($primaryKeyValue, $seenPrimaryKeys) || $nimGroups[$primaryKeyValue]->count() > 1) {
                $isDuplicate = true;
                $duplicateMessage .= "- Duplicate {$this->primaryKey}";
            }

            $secondaryKeyValue = $group->first()[$this->secondaryKey];
            if (in_array($secondaryKeyValue, $seenSecondaryKeys)) {
                $isDuplicate = true;
                $duplicateMessage .= ($duplicateMessage ? "<br>" : "") . "- Duplicate {$this->secondaryKey}";
            }

            // Check if the email is duplicate
            if ($emailGroups[$secondaryKeyValue]->count() > 1) {
                $isDuplicate = true;
                $duplicateMessage .= ($duplicateMessage ? "<br>" : "") . "- Duplicate {$this->secondaryKey}";
            }           
            
            if($this->thirdKey) {    
                $thirdKeyValue = $group->first()[$this->thirdKey];
                if (in_array($thirdKeyValue, $seenThirdKeys)) {
                    $isDuplicate = true;
                    $duplicateMessage .= ($duplicateMessage ? "<br>" : "") . "- Duplicate {$this->thirdKey}";
                }          

                if ($thirdGroups[$thirdKeyValue]->count() > 1) {
                    $isDuplicate = true;
                    $duplicateMessage .= ($duplicateMessage ? "<br>" : "") . "- Duplicate {$this->thirdKey}";
                }
            }

            if ($group->count() === 1 && !$this->hasErrors($validatedGroup->first()) && !$isDuplicate) {
                $this->cleanedData->push($group->first());
                $seenPrimaryKeys[] = $primaryKeyValue;
                $seenSecondaryKeys[] = $secondaryKeyValue;
                if($this->thirdKey) { 
                    $seenThirdKeys[] = $thirdKeyValue;
                }
            } else {
                if ($isDuplicate) {
                    $validatedGroup = $validatedGroup->map(function ($item) use ($duplicateMessage) {
                        $item[$this->primaryKey . '_error'] = str_contains($duplicateMessage, "- Duplicate {$this->primaryKey}") ? "Duplicate {$this->primaryKey}" : $item[$this->primaryKey . '_error'];
                        $item[$this->secondaryKey . '_error'] = str_contains($duplicateMessage, "- Duplicate {$this->secondaryKey}") ? "Duplicate {$this->secondaryKey}" : $item[$this->secondaryKey . '_error'];
                        if($this->thirdKey) { 
                            $item[$this->thirdKey . '_error'] = str_contains($duplicateMessage, "- Duplicate {$this->thirdKey}") ? "Duplicate {$this->thirdKey}" : "";
                        }
                        $item['duplicate_error'] = $duplicateMessage;
                        $item['messages'] .= $item['messages'] ? "<br>" . $item['duplicate_error'] : $item['duplicate_error'];
                        return $item;
                    });
                }
                $this->failedData[$primaryKeyValue] = $validatedGroup;
            }
        });
        //===============[3]================       

        $this->failedData = $this->failedData->flatten(1);

        // Move all instances of duplicate emails to failedData
        $duplicateEmails = $emailGroups->filter(function ($group) {
            return $group->count() > 1;
        })->keys();

        $this->cleanedData = $this->cleanedData->reject(function ($item) use ($duplicateEmails) {
            if ($duplicateEmails->contains($item[$this->secondaryKey])) {
                $item['duplicate_error'] = "Duplicate {$this->secondaryKey}";
                $item['messages'] .= $item['messages'] ? "<br>" . $item['duplicate_error'] : $item['duplicate_error'];
                $this->failedData->push($item);
                return true;
            }
            return false;
        });
    }

    public function cleanDuplicateData()
    {
        // Check for existing data in the database
        $existingAllData = $this->model::whereIn($this->primaryKey, $this->cleanedData->pluck($this->primaryKey))
            ->orWhereIn($this->secondaryKey, $this->cleanedData->pluck($this->secondaryKey))
            ->get()
            ->keyBy($this->primaryKey);

        foreach ($this->cleanedData as $row) {
            if ($existingAllData->has($row[$this->primaryKey]) ||
                $existingAllData->contains($this->secondaryKey, $row[$this->secondaryKey])) {
                $existingData = $existingAllData[$row[$this->primaryKey]] ??
                                $existingAllData->firstWhere($this->secondaryKey, $row[$this->secondaryKey]);
                $differences = $this->findDifferences($existingData, $row);
                if ($differences) {
                    $this->duplicatedData->push([
                        'existing' => $existingData->toArray(),
                        'new' => $row,
                        'differences' => $differences
                    ]);
                }
            } else {
                $this->newData->push($row);
            }
        }
    }

    private function addErrorMessages($item, $validator)
    {
        $itemWithErrors = $item->toArray();
        $messages = [];
        foreach ($this->dbColumns as $column) {
            $errorMessage = $validator->errors()->first($column);
            $itemWithErrors["{$column}_error"] = $errorMessage ?? "";

            if ($errorMessage && !in_array("- " . $errorMessage, $messages)) {
                $messages[] = "- " . $errorMessage;
            }
        }

        $itemWithErrors['messages'] = implode('<br>', $messages);
        return $itemWithErrors;
    }

    private function hasErrors($item)
    {
        return collect($item)
            ->filter(function ($value, $key) {
                return str_ends_with($key, '_error');
            })
            ->filter()
            ->isNotEmpty();
    }

    private function isEmptyRow($newData)
    {
        $isEmptyRow = [];

        foreach ($this->excelColumns as $field) {
            if ($newData[$field] == '' ) {
                $isEmptyRow[$field] = true;
            }
        }

        if (count($isEmptyRow) == count($this->excelColumns)) {
            return false;
        }

        return true;
    }

    private function findDifferences($existingData, $newData)
    {
        $differences = [];

        foreach ($this->dbColumns as $field) {
            if ($existingData->$field != $newData[$field]) {
                $differences[$field] = true;
            }
        }

        return $differences;
    }

    public function getCleanedData()
    {
        return $this->cleanedData;
    }

    public function getFailedData()
    {
        return $this->failedData;
    }

    public function getNewData()
    {
        return $this->newData;
    }

    public function getDuplicatedData()
    {
        return $this->duplicatedData;
    }
}
