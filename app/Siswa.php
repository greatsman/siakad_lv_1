<?php

namespace App;

use App\Mapel;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    //
    //agar laravel dapat mengenal data kita
    protected $table = 'siswa';
    //agar laravel dapat menambahkan ke dalam database
    protected $fillable = ['user_id','nama_depan','nama_belakang','jenis_kelamin','agama','alamat','avatar'];

    public function getAvatar()
    {
        if (!$this->avatar) {
            return asset('images/default.png');
        }
        return asset('images/'.$this->avatar);
    }

    public function mapel()
    {
     return $this->belongsToMany(Mapel::class)->withPivot('nilai')->withTimestamps();  //untuk mengambil nilai dari pivot 
    }

    public function rataRataNilai()
    {
        $total_nilai = 0;
        $total_mapel = 0;
        If($this->mapel->isNotEmpty()){
            foreach ($this -> mapel as $mapel){
                $total_nilai += $mapel->pivot->nilai;
                $total_mapel ++;
            }

            return 0 ? 0 : round($total_nilai/$total_mapel);
        }
        return 0; 
    }

    public function nama_lengkap()
    {
        return $this->nama_depan.' '.$this->nama_belakang;
    }
}
