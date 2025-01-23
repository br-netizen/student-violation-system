<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    //
    protected $fillable = [
        'kode', 'nama_jurusan'
    ];


    public function kelas() {
        return $this->hasMany(Kelas::class);
    }
}
