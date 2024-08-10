<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPesanan extends Model
{
    use HasFactory;
    protected $table = 'detail_pesanan';
    protected $primaryKey = 'id';
    protected $fillable = ['id_pesanan','nama_pemesan','panjang_lengan','lingkar_dada',
                            'lingkar_pinggang','panjang_baju','lingkar_lengan','id_karyawan','status'];
                            
}

