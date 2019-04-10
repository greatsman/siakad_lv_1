<?php

namespace App;

use App\Siswa;
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    // //agar laravel dapat mengenal data kita
    protected $table = 'mapel';
    //agar laravel dapat menambahkan ke dalam database
    protected $fillable = ['kode','nama','semester'];

    public function siswa()
    {
        return $this->belongsToMany(Siswa::class)->withPivot('nilai'); //untuk mengambil nilai dari pivot
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class); //satu mapel dimiliki guru
    }
}