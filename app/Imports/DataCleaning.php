<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;

class DataCleaning
{
    protected $primaryKey;
    protected $secondaryKey;
    protected $model;
    protected $excelColumns;
    protected $dbColumns;
    protected $validationRules;
    protected $validationMessages;
    protected $cleanedData;
    protected $newData;
    protected $duplicatedData;
    protected $failedData;

    public function __construct($primaryKey, $secondaryKey, $model, $excelColumns, $dbColumns, $validationRules, $validationMessages)
    {
        $this->primaryKey = $primaryKey;
        $this->secondaryKey = $secondaryKey;
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
                    $mappedRow[$dbColumn] = $row[$excelColumn] ?? null;
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
        $emailGroups = $dedupedGroupedRows->flatten(1)->groupBy($this->secondaryKey);
        $nimGroups = $dedupedGroupedRows->flatten(1)->groupBy($this->primaryKey);

        $dedupedGroupedRows->each(function ($group, $primaryKeyValue) use (&$seenPrimaryKeys, &$seenSecondaryKeys, $emailGroups, $nimGroups) {
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

            if ($group->count() === 1 && !$this->hasErrors($validatedGroup->first()) && !$isDuplicate) {
                $this->cleanedData->push($group->first());
                $seenPrimaryKeys[] = $primaryKeyValue;
                $seenSecondaryKeys[] = $secondaryKeyValue;
            } else {
                if ($isDuplicate) {
                    $validatedGroup = $validatedGroup->map(function ($item) use ($duplicateMessage) {
                        $item[$this->primaryKey . '_error'] = str_contains($duplicateMessage, "- Duplicate {$this->primaryKey}") ? "Duplicate {$this->primaryKey}" : "";
                        // $item[$this->secondaryKey . '_error'] = str_contains($duplicateMessage, "- Duplicate {$this->secondaryKey}") ? "Duplicate {$this->secondaryKey}" : "";
                        $item['duplicate_error'] = $duplicateMessage;
                        $item['messages'] .= $item['messages'] ? "<br>" . $item['duplicate_error'] : $item['duplicate_error'];
                        return $item;
                    });
                }
                $this->failedData[$primaryKeyValue] = $validatedGroup;
            }
        });
        //===============[3]================

        // //===============[3]================
        // $seenPrimaryKeys = [];
        // $seenSecondaryKeys = [];
        // $emailGroups = $dedupedGroupedRows->flatten(1)->groupBy($this->secondaryKey);

        // $dedupedGroupedRows->each(function ($group, $primaryKeyValue) use (&$seenPrimaryKeys, &$seenSecondaryKeys, $emailGroups) {
        //     // Validate each item in the group
        //     $validatedGroup = $group->map(function ($item) {
        //         $validator = Validator::make($item->toArray(), $this->validationRules, $this->validationMessages);
        //         return $this->addErrorMessages($item, $validator);
        //     });

        //     $isDuplicate = false;
        //     $duplicateMessage = '';

        //     if (in_array($primaryKeyValue, $seenPrimaryKeys)) {
        //         $isDuplicate = true;
        //         $duplicateMessage .= "Duplicate {$this->primaryKey}";
        //     }

        //     $secondaryKeyValue = $group->first()[$this->secondaryKey];
        //     if (in_array($secondaryKeyValue, $seenSecondaryKeys)) {
        //         $isDuplicate = true;
        //         $duplicateMessage .= ($duplicateMessage ? "<br>" : "") . "Duplicate {$this->secondaryKey}";
        //     }

        //     // Check if the email is duplicate
        //     if ($emailGroups[$secondaryKeyValue]->count() > 1) {
        //         $isDuplicate = true;
        //         $duplicateMessage .= ($duplicateMessage ? "<br>" : "") . "Duplicate {$this->secondaryKey}";
        //     }

        //     if ($group->count() === 1 && !$this->hasErrors($validatedGroup->first()) && !$isDuplicate) {
        //         $this->cleanedData->push($group->first());
        //         $seenPrimaryKeys[] = $primaryKeyValue;
        //         $seenSecondaryKeys[] = $secondaryKeyValue;
        //     } else {
        //         if ($isDuplicate) {
        //             $validatedGroup = $validatedGroup->map(function ($item) use ($duplicateMessage) {
        //                 $item['duplicate_error'] = $duplicateMessage;
        //                 $item['messages'] .= $item['messages'] ? "<br>" . $item['duplicate_error'] : $item['duplicate_error'];
        //                 return $item;
        //             });
        //         }
        //         $this->failedData[$primaryKeyValue] = $validatedGroup;
        //     }
        // });
        // //===============[3]================

        // Flatten the failedData
        $flattenedFailedData = array_reduce($this->failedData->toArray(), function ($carry, $items) {
            foreach ($items as $item) {
                $carry[] = $item;
            }
            return $carry;
        }, []);
        $this->failedData = collect($flattenedFailedData);

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
