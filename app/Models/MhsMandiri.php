<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;


class MhsMandiri extends Model
{
    use HasUuids;

    protected $table = 'mhs_mandiri';
    protected $fillable = ['nim', 'startdate', 'enddate', 'bukti_doc', 'status'];
    protected $primaryKey = 'id_mhsmandiri';
    protected $keyType = 'string';
    public $timestamps = false;

    public function PengajuanMandiri()
    {
        return $this->belongsTo(PengajuanMandiri::class, 'id_pengajuan');
    }   
}