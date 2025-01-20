<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = \App\Models\User::create([
            'username'   => 'admin',
            'password'   => Hash::make('123'),
            'is_default' => '0',
            'is_ldap'    => '0',
            'status'     => '1',
        ]);

        $unit = [
            'PT Jasamarga Transjawa Tol',
            'PT Jasamarga Lingkar Luar Jakarta',
            'PT Jasamarga Japek Selatan',
            'PT Jasamarga Pandaan Tol',
            'PT Jasamarga Pandaan Malang',
            'PT Jasamarga Solo Ngawi',
            'PT Jasamarga Ngawi Kertosono Kediri',
            'PT Jasamarga Manado Bitung',
            'PT Jasamarga Bali Tol',
        ];

        foreach($unit as $u) {
            \App\Models\Unit::create([
                'unit' => $u,
                'status' => '1'
            ]);
        }

        $ruas = [
            'Jakarta Bogor Ciawi'
        ];

        foreach($ruas as $r) {
            \App\Models\Ruas::create([
                'unit_id' => '1',
                'ruas_name' => $r,
                'long' => '34',
                'km_awal' => '1',
                'km_akhir' => '34',
                'status' => '1',
            ]);
        }
    }
}
