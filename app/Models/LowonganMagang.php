<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LowonganMagang extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'lowongan_magang';
    protected $guarded = [];
    protected $primaryKey = 'id_lowongan';
    protected $fillable = [
        'created_by', 
        'id_jenismagang', 
        'created_at',
        'intern_position',
        'durasimagang',
        'deskripsi',
        'requirements',
        'kuota',
        'benefitmagang',
        'startdate',
        'enddate',
        'tahapan_seleksi',
        'date_confirm_closing',
        'applicant_status',
        'pelaksanaan',
        'jenjang',
        'keterampilan',
        'id_industri',
        'id_flow',
        'nominal_salary',
        'gender',
        'status',
        'prodi',
        'id_prodi',
        'id_fakultas',
        'alasantolak',
        'statusaprove',
        'lokasi'
    ];
    protected $keyType = 'string';
    protected $casts = [
        'date_confirm_closing' => 'datetime',
        'startdate' => 'datetime',
        'enddate' => 'datetime'
    ];
    const UPDATED_AT = null;
    public $timestamps = false;

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_at = $model->freshTimestamp();
        });
    }

    public function industri()
    {
        return $this->belongsTo(Industri::class, 'id_industri');
    }
    public function tahunAkademik()
    {
        return $this->belongsTo(TahunAkademik::class, 'id_year_akademik');
    }
    public function jenisMagang()
    {
        return $this->belongsTo(JenisMagang::class, 'id_jenismagang');
    }
    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class, 'id_lokasi');
    }
    public function prodi()
    {
        return $this->belongsTo(ProgramStudi::class, 'id_prodi');
    }
    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class, 'id_fakultas');
    }
    public function total_pelamar()
    {
        return $this->hasMany(PendaftaranMagang::class, 'id_lowongan');
    }
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim');
    }
    public function univ()
    {
        return $this->belongsTo(Universitas::class, 'id_univ');
    }
    public function seleksi()
    {
        return $this->hasMany(SeleksiTahap::class, 'id_lowongan');
    }
    public function prodilowongan()
    {
        return $this->hasManyThrough(
            ProgramStudi::class, 
            LowonganProdi::class,
            'lowongan_prodi_id',
            'id_lowongan',
            'id_prodi'
        );
    }
}
