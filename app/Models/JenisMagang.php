<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisMagang extends Model
{
    use HasUuids;

    protected $table = 'jenis_magang';
    protected $fillable = ['namajenis', 'durasimagang', 'is_review_process', 'is_document_upload', 'type', 'status'];
    protected $primaryKey = 'id_jenismagang';
    protected $keyType = 'string';
    public $timestamps= false;
    
}
