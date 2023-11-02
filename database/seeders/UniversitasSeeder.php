<?php

namespace Database\Seeders;

use App\Models\Universitas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UniversitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Universitas::create([
            
            'id_univ'=> '7e724275-a2c6-45cd-876a-0e259bc726fb',
            'namauniv'=> 'Telyu', 
            'jalan'=>'jln.telokmunikasi', 
            'kota'=>'bandung', 
            'telp'=>'0987654', 
            'status'=> 1
    ]);
        Universitas::create([
                
            'id_univ'=> 'c1bc5845-06fb-49b2-ad1b-fff94f5884ed',
            'namauniv'=> 'Telkom University', 
            'jalan'=>'jln.telokmunikasi', 
            'kota'=>'bandung', 
            'telp'=>'098765432', 
            'status'=> 1
        ]);
}
}