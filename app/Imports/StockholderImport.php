<?php

namespace App\Imports;

use App\Models\Stockholder;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class StockholderImport implements ToModel, WithHeadingRow, WithUpserts
{
    public function model(array $row)
    {
        return new Stockholder([
            'name' => $row['name'],
            'sex' => $row['gender'],
            'dob' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row["dob"]),
            'email' => $row['email'],
            'phoneNumber' => $row['phone_number'],
            'address' => $row['address'],
            'sharesOwned' => $row['shares_owned'],
            'investmentDate' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row["investment_date"]),
            'prefferedContact' => $row['preffered_contact'],
        ]);
    }

    public function uniqueBy()
    {
        return ['email', 'phoneNumber'];
    }
}
