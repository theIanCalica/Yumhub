<?php

namespace App\Imports;

use App\Models\Rider;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class RiderImport implements ToModel, WithHeadingRow, WithUpserts
{
    public function model(array $row)
    {

        if (!isset($row['first_name'])) {
            return null;
        }

        return new Rider([
            'fname'  => $row["first_name"],
            'lname' => $row['last_name'],
            'sex' => $row["gender"],
            'dob' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row["date_of_birth"]),
            'phoneNumber' => $row['phone_number'],
            'email' => $row['email'],
            'hiredDate' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row["hired_date"]),
            'employmentStatus' => $row['employment_status'],
            'salary' => $row['salary'],
            'address' => $row['address'],
            'motorModel' => $row['motor_model'],
        ]);
    }

    public function uniqueBy()
    {
        return ['email', 'phoneNumber'];
    }
}
