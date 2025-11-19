<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

        public function pangkat()
    {
        return $this->hasOne(Pangkat::class, 'id', 'id_pangkat');
    }
}
