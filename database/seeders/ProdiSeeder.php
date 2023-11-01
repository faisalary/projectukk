<?php

namespace Database\Seeders;

use App\Models\ProgramStudi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProgramStudi::create([
                
            'id_univ'=> '7e724275-a2c6-45cd-876a-0e259bc726fb',
            'id_fakultas'=> 'd8c34ec5-a0e4-479f-84a2-67dcc9d7fc7b', 
            'id_prodi'=>'ad54a912-e4bf-4560-8bfe-22d24ee5360d', 
            'namaprodi'=>'D3 Sistem Informasi'
        ]);
        ProgramStudi::create([
                
            'id_univ'=> 'c1bc5845-06fb-49b2-ad1b-fff94f5884ed',
            'id_fakultas'=> '6c39f720-58d8-4890-957e-2bcebe562095', 
            'id_prodi'=>'e9129bed-7dbc-4480-a041-05534b4d32f4', 
            'namaprodi'=>'D3 RPL' 
        ]);
    }
}