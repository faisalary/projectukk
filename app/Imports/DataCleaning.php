<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;

// DataCleaning class is used to clean and validate data from excel file
// It will clean the data based on the required columns and validation rules
// The cleaned data will be stored in $cleanedData property
// The failed data will be stored in $failedData property
// The cleaned data and failed data can be accessed using getCleanedData() and getFailedData() method

class DataCleaning
{
    protected $primaryKey;
    protected $model;
    protected $excelColumns;
    protected $dbColumns;
    protected $validationRules;
    protected $validationMessages;
    protected $cleanedData;
    protected $newData;
    protected $duplicatedData;
    protected $failedData;

    public function __construct($primaryKey, $model, $excelColumns, $dbColumns, $validationRules, $validationMessages)
    {
        $this->primaryKey = $primaryKey;
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
        // Ambil data sesuai panjang excelColumns (table header) dan hilangkan baris dengan NIP null, jika nip kosong maka data akan di abaikan
        $rows = $rows->map(function ($row) {
            if (!empty($this->primaryKey)) {
                return $row->only($this->excelColumns);
            }
            return $row;
        })->filter(function ($row) {
            return !is_null($row[$this->primaryKey]) && $row[$this->primaryKey] !== '';
        });

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

        //Di kelompokkan berdasarkan primary key
        $groupedRows = $rows->groupBy($this->primaryKey);
        //===============[1]================

        //===============[2]================
        // Menghilangkan duplikasi dalam setiap grup
        $dedupedGroupedRows = $groupedRows->map(function ($group) {
            return $group->unique(function ($item) {
                return implode('', $item->toArray());
            });
        });
        //===============[2]================

        //===============[3]================
        //Validasi setiap kelompok (group) yang sudah di deduplikasi (dedupedGroupedRows) dengan validasi yang sudah di set dan pesan error yang sudah di set (validationRules, validationMessages)
        $dedupedGroupedRows->each(function ($group, $primaryKeyValue) {
            //Validasi setiap item dalam kelompok
            $validatedGroup = $group->map(function ($item) {
                $validator = Validator::make($item->toArray(), $this->validationRules, $this->validationMessages);
                return $this->addErrorMessages($item, $validator);
            });

            //Jika kelompok hanya memiliki 1 item dan tidak memiliki error, maka item tersebut akan di masukkan ke cleanedData
            if ($group->count() === 1 && !$this->hasErrors($validatedGroup->first())) {
                $this->cleanedData->push($group->first());
            }
            //Jika kelompok memiliki lebih dari 1 item atau memiliki error, maka semua item dalam kelompok akan di masukkan ke failedData
            else {                
                $this->failedData[$primaryKeyValue] = $validatedGroup;
            }
        });
        //===============[3]================

        // add duplicate data message
        $this->failedData = $this->failedData->map(function ($itemCollection, $primaryKey) {
            // Jika ada lebih dari satu item di dalam collection            
            if ($itemCollection->count() > 1) {
                $itemCollection = $itemCollection->map(function ($item) {
                    $item["duplicate_error"] = "Duplicate {$this->primaryKey}";
                    $item["messages"] .= $item['messages'] ? "<br>- " . $item["duplicate_error"] : "- " . $item["duplicate_error"];
                    return $item;
                });
            }
        
            return $itemCollection;
        });

        
        // Flat the failedData
        $flattenedFailedData = array_reduce($this->failedData->toArray(), function ($carry, $items) {
            foreach ($items as $item) {
                $carry[] = $item;
            }
            return $carry;
        }, []);
        $this->failedData = collect($flattenedFailedData);
    }

    public function cleanDuplicateData()
    {
        // Mencari data yang sudah ada di database
        $existingAllData = $this->model::whereIn($this->primaryKey, $this->cleanedData->pluck($this->primaryKey))->get()->keyBy($this->primaryKey);

        foreach ($this->cleanedData as $row) {
            if ($existingAllData->has($row[$this->primaryKey])) {
                $existingData = $existingAllData[$row[$this->primaryKey]];
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

            // Jika ada error, tambahkan ke array messages
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

    private function findDifferences($existingDosen, $newData)
    {
        $differences = [];

        foreach ($this->dbColumns as $field) {
            if ($existingDosen->$field != $newData[$field]) {
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
