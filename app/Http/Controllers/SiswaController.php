<?php

namespace App\Http\Controllers;

use App\Siswa;
use App\User;

use Illuminate\Http\Request;
use App\Http\Requests\SiswaRequest;
use App\Http\Requests\SiswaUpdateRequest;
use Illuminate\Support\Facades\DB;
use PDF;

//untuk export
use App\Exports\SiswaExport;
use Maatwebsite\Excel\Facades\Excel;

class SiswaController extends Controller
{
    //untuk menampikjan halaman siswa
    public function index(Request $request)
    {
        if ($request->has('cari')) {
            $data_siswa = Siswa::where('nama_depan','LIKE','%' .$request->cari. '%')->get();
        } else {
            $data_siswa = Siswa::all();
        }
        return view('siswa.index',['data_siswa' => $data_siswa]);
    }
    // untuk proses menambahkan siswa
    public function create(SiswaRequest $request)
    {
        $request->validated();
        //insert table user
        $user = new User;
        $user->role = 'siswa';
        $user->name = $request->nama_depan;
        $user->email = $request->email;
        $user->password = bcrypt('rahasia');
        $user->remember_token= str_random(60);
        $user->save();
        
        //insert table siswa
        $request->request->add(['user_id'=>$user->id]);
        $data_siswa = Siswa::create($request->all());
        if ($request->hasFile('avatar')) {
            $request->file('avatar')->move('images',$request->file('avatar')->getClientOriginalName());
            $data_siswa->avatar = $request->file('avatar')->getClientOriginalName();
            $data_siswa->save();
        }
        return redirect('/siswa')->with('sukses','Data Berhasil Disimpan');
    }
    //untuk menampilkan data yang diedit
    public function edit(Siswa $data_siswa)
    {
        // $data_siswa = Siswa::find($id);
        $user = User::find($data_siswa -> user_id);
        if ($data_siswa -> user_id != 0 ) {
            $data_siswa -> email = $user->email;
        }
        return view('siswa.edit',['data_siswa' => $data_siswa]);
    }
    //untuk proses update data
    public function update(SiswaUpdateRequest $request,Siswa $data_siswa)
    {
        $request->validated(4);
        if ($data_siswa -> user_id == 0) {
            $user = new User;
            $user->role = 'siswa';
            $user->name = $request->nama_depan;
            $user->email = $request->email;
            $user->password = bcrypt('rahasia');
            $user->remember_token= str_random(60);
            $user->save();
            $data_siswa -> user_id = $user->id;
        }
        if ($request->hasFile('avatar')) {
            $request->file('avatar')->move('images',$request->file('avatar')->getClientOriginalName());
            $data_siswa->avatar = $request->file('avatar')->getClientOriginalName();
            $data_siswa->save();
        }
        else {
            $data_siswa->update($request->all());
        }
        return redirect('/siswa')->with('sukses','Data Berhasil Diupdate');
    }
    //untuk proses menghapus data
    public function delete(Siswa $data_siswa)
    {
        $data_siswa->delete();
        return redirect('/siswa')->with('sukses','Data Berhasil Dihapus');
    }
    //untuk melihat profile
    public function profile(Siswa $data_siswa)
    {
        $data_mapel = \App\Mapel::all();
        $nama_pelajaran = [];
        $nilai=[];
        foreach ($data_mapel as $nama){
            if ($data_siswa->mapel()->wherePivot('mapel_id',$nama->id)->first()) {
                $nama_pelajaran[] = $nama->nama;
                $nilai[]=$data_siswa->mapel()->wherePivot('mapel_id',$nama->id)->first()->pivot->nilai;
            }
        }
        return view('siswa.profile',[
                    'data_siswa' => $data_siswa,
                    'data_mapel' => $data_mapel,
                    'nama_pelajaran' => $nama_pelajaran,
                    'nilai' => $nilai]);
    }
    
    public function addnilai(Request $request,Siswa $data_siswa)
    {
        if ($data_siswa->mapel()->where('mapel_id',$request->mapel_id)->exists()) {
            return redirect('/siswa/profile/'.$data_siswa->id)->with('eror','Nilai Sudah Ada');
        }
        $data_siswa->mapel()->attach($request->mapel_id,['nilai'=> $request->nilai]);
        return redirect('/siswa/profile/'.$data_siswa->id)->with('sukses','Nilai Berhasil Ditambahkan');
    }

    public function deletenilai($id,$id_mapel)
    {
        $data_nilai = DB::table('mapel_siswa')->where([['siswa_id',$id],['mapel_id',$id_mapel]]);
        $data_nilai->first();
        $data_nilai->delete();
        return redirect('/siswa/profile/'.$id)->with('sukses','Data Berhasil dihapus');

    }

    //export excel
    public function exportExcel() 
    {
        return Excel::download(new SiswaExport, 'siswa.xlsx');
    }

     //export pdf
     public function exportPDF() 
     {
        $siswa= Siswa::all();
        $pdf = PDF::loadView('export.siswapdf',['siswa' => $siswa]);
        return $pdf->download('siswa.pdf');
     }
    
    
}
