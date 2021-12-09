<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;

class UsersImport implements ToModel,WithHeadingRow
{
    private $password;

    public function __construct()
    {
        $this->password = Hash::make(123456);
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'job_title' => $row['job_title'],
            'email' => $row['email'],
            'site' => $row['site'],
            'department' => $row['department'],
            'password'  =>  $this->password,
        ]);
    }
}
