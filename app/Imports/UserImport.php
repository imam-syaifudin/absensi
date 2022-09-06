<?php

namespace App\Imports;

use Illuminate\Support\Str; 
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;

class UserImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            // 
            'pengaturan_id' => $row[0],
            'name' => $row[1],
            'nip' => $row[2],
            'level' => 'user',
            'password' => bcrypt('12345'),
            'remember_token' => Str::random(60),
        ]);
    }
}
