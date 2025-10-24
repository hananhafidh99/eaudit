<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengawasan extends Model
{
    use HasFactory;

    protected $table = 'pengawasans';

    protected $fillable = [
        'tipe',
        'jenis',
        'wilayah',
        'pemeriksa',
        'status_LHP',
        'id_penugasan',
        'tglkeluar',
        'alasan_verifikasi',
        'tgl_verifikasi'
    ];

    protected $dates = [
        'tglkeluar',
        'tgl_verifikasi'
    ];

    /**
     * Get the data dukung for the pengawasan
     */
    public function dataDukung()
    {
        return $this->hasMany(DataDukung::class, 'id_pengawasan');
    }
}
