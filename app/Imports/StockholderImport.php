<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class StockholderImport implements ToModel, WithHeadingRow, WithUpserts
{
    public function model(array $row)
    {
        return new User([
            'fname' => $row['firstName'],
            'lname' => $row['lastName'],
            'gender' => $row['gender'],
            'dob' => $row['dob'],
            'email' => $row['email'],
            'phoneNumber' => $row['phoneNumber'],
            'region' => $row['region'],
            'province' => $row['province'],
            'city' => $row['city'],
            'barangay' => $row['barangay'],
            'street' => $row['street'],
            'houseNo' => $row['houseNumber'],
            'zipCode' => $row['zipCode'],
            'password' => bcrypt($row['password']),
            'role' => $row['role'],
            'is_disabled' => $row['status'],
        ]);
    }

    public function uniqueBy()
    {
        return ['email', 'phoneNumber'];
    }
}
