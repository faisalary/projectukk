<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class email_template extends Model
{

    use HasFactory, HasUuids;
    protected $table = 'email_template';
    protected $fillable = ['subject_email','headline_email','content_email', 'attachment'];
    protected $keyType = 'string';
    protected $primaryKey = 'id_email_template';
    public $timestamps = false;
}