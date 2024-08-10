<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekap extends Model
{
    use HasFactory;
    protected $table = 'rekap_jahitan';
    protected $primaryKey = 'id';
    protected $fillable = ['id_detail','id_pengerja','id_busana','status'];
}
