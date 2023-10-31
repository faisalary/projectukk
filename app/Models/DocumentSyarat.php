<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DocumentSyarat extends Model
{
    use HasUuids;

    protected $table = 'document_syarat';
    protected $fillable = ['namadocument', 'status'];
    protected $primaryKey = 'id_document';
    protected $keyType = 'string';
}
