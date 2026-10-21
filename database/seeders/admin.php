<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class admin extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //created user root

        User::create([
            'name'=>'BENHUR',
            'email'=>'kizalu@gmail.com',
            'password'=>bcrypt(123456789),
            'isAdmin'=>1,
            'isResponsavel'=>1,
            'isEstatistico'=>1,
            'isSecretaria'=>1,
        ]);


    }
}
