<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Busana extends Model
{
    use HasFactory;
    protected $table = 'busana';
    protected $primaryKey = 'id';
    protected $fillable = ['jenis_busana','upahPcs'];
}
