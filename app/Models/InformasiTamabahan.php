<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformasiTamabahan extends Model
{
    use HasFactory;
    protected $table = 'bahasa';
    protected $fillable = ['id_infotab','nim', 'lok_kerja', 'sosmed', 'id_bahasa'];
    protected $primaryKey = 'id_bahasa';
    protected $keyType = 'string';
    public $timestamps = false;

    public function bahasa()
    {
        return $this->belongsTo(Bahasa::class, "id_bahasa");
    }

}
