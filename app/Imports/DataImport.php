<?php

namespace App\Imports;

use App\Data;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DataImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
                return new Data([
            'date_create' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['create_date']),
            'due_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['due_date']),
            'status_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['status_date']),
            'carp_code' => $row['carp_code'], 
            'category' => $row['category'], 
            'initiator' => $row['initiator'], 
            'initiator_div' => $row['initiator_div'], 
            'initiator_branch' => $row['initiator_branch'], 
            'recipient' => $row['recipient'], 
            'recipient_div' => $row['recipient_div'], 
            'recipient_branch' => $row['recipient_branch'], 
            'verified_by' => empty($row['verified_by']) ? '-' : $row['verified_by'], 
            'effectiveness' => empty($row['effectiveness']) ? '-' : $row['effectiveness'], 
            'stage' => $row['stage'], 
            'status' => $row['status'], 
        ]);
    }
}
