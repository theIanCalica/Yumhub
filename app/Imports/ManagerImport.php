<?php

namespace App\Imports;

use App\Models\Manager;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ManagerImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        if (!isset($row['first_name'])) {
            return null;
        }
        return new Manager([
            'fname'  => $row["first_name"],
            'lname' => $row['last_name'],
            'DOB' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row["dob"]),
            'sex' => $row["gender"],
            'address' => $row['address'],
            'phoneNumber' => $row['phone_number'],
            'hiredDate' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row["hired_date"]),
            'email' => $row['email'],
            'employmentStatus' => $row['employment_status'],
            'salary' => $row['salary'],
        ]);
    }

    public function uniqueBy()
    {
        return ['email', 'phoneNumber'];
    }
}
