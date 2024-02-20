<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'education';
    protected $fillable =[
        'nim',
        'name_intitutions',
        'tingkat',
        'startdate',
        'enddate',
        'nilai'
    ];
    protected $primaryKey = 'id_education';
    protected $keyType = 'string';
    public $timestamps = false;


    public function nilai(){
        return $this->belongsTo(InformasiPribadi::class,'nilai');
    }
}
