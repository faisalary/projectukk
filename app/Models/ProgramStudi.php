<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramStudi extends Model
{
    use HasUuids;

    protected $table = 'program_studi';
    protected $fillable = ['namaprodi'];
    protected $primaryKey = 'id_prodi';
    protected $keyType = 'string';
}
