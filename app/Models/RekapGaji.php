<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekapGaji extends Model
{
    use HasFactory;
    protected $table = 'rekap_gaji';
    protected $primaryKey = 'id';
    protected $fillable = ['id_karyawan_gaji', 'jumlah_upah', 'jumlah_jahit'];

}
