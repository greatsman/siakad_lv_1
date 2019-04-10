<?php
use App\Siswa;
use App\Guru;
use App\Mapel;


    function ranking5besar(){
            $siswa = Siswa::all();
            $siswa->map(function($s){
                $s->rataRataNilai = $s->rataRataNilai();
                return $s;
            });
            $siswa = $siswa->sortByDesc('rataRataNilai')->take(5);
            return $siswa;
    }
    
    function jumlahGuru(){
            return Guru::count();
    }

    function jumlahSiswa(){
            return Siswa::count();
    }

    function jumlahMapel(){
        return Mapel::count();
    }