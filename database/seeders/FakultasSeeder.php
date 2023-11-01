<?php

namespace Database\Seeders;

use App\Models\Fakultas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FakultasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Fakultas::create([
                
            'id_univ'=> 'c1bc5845-06fb-49b2-ad1b-fff94f5884ed',
            'id_fakultas'=> '0c4c6d14-7457-4858-a844-315936e5825c', 
            'namafakultas'=>'FIT', 
        ]);
        Fakultas::create([
                
            'id_univ'=> 'c1bc5845-06fb-49b2-ad1b-fff94f5884ed',
            'id_fakultas'=> '6c39f720-58d8-4890-957e-2bcebe562095', 
            'namafakultas'=>'FIK', 
        ]);
        Fakultas::create([
                
            'id_univ'=> '7e724275-a2c6-45cd-876a-0e259bc726fb',
            'id_fakultas'=> 'd8c34ec5-a0e4-479f-84a2-67dcc9d7fc7b', 
            'namafakultas'=>'FEB', 
        ]);
        
    }
}