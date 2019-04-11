@extends('layouts.master')
@section('content')
<div class="main">
                <!-- MAIN CONTENT -->
                <div class="main-content">
                    <div class="container-fluid">
                         @if (session('sukses'))
                            <div class="alert alert-success alert-dismissible" role="alert">
                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                 <i class="fa fa-check-circle"></i> {{session('sukses')}}
                             </div>
                         @endif
                        <div class="row">
                            <div class="col-md-12">
                                <!-- TABLE HOVER -->
                                        <div class="panel">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">Edit Siswa</h3>
                                            </div>
                                            <div class="panel-body">
                                                <form action="/siswa/update/{{$data_siswa->id}}" method="POST" enctype="multipart/form-data">
                                                        {{ csrf_field() }}
                                                                <div class="form-group">
                                                                        <label for="nama_depan">Nama Depan</label>
                                                                        <input type="text" class="form-control" name="nama_depan" placeholder="Nama Depan" value={{$data_siswa->nama_depan}}>
                                                                </div>
                                                                <div class="form-group">
                                                                        <label for="nama_belakang">Nama Belakang</label>
                                                                        <input type="text" class="form-control" name="nama_belakang" placeholder="Nama Belakang" value={{$data_siswa->nama_belakang}}>
                                                                </div>
                                                                <div class="form-group {{$errors->has('email') ? 'has-error':''}}">
                                                                        <label for="nama_belakang">Email</label>
                                                                        <input type="email" class="form-control" name="email" placeholder="email" value={{$data_siswa->email}}>
                                                                </div>
                                                                @if ($errors->has('email'))
                                                                        <span class="help-block">{{ $errors->first('email') }}</span>
                                                                @endif
                                                                <div class="form-group">
                                                                        <label for="jenis_kelamin">Jenis Kelamin</label>
                                                                        <select class="form-control" name="jenis_kelamin">
                                                                        <option value="L" @if($data_siswa->jenis_kelamin == 'L') selected @endif>Laki-Laki</option>
                                                                        <option value="P" @if($data_siswa->jenis_kelamin == 'P') selected @endif>Perempuan</option>
                                                                        </select>
                                                                </div>
                                                                <div class="form-group">
                                                                        <label for="agama">Agama</label>
                                                                        <input type="text" class="form-control" name="agama" placeholder="Agama" value={{$data_siswa->agama}}>
                                                                </div>
                                                                <div class="form-group">
                                                                        <label for="alamat">Alamat</label>
                                                                        <textarea class="form-control" name="alamat" rows="3">{{$data_siswa->alamat}}</textarea>
                                                                </div>
                                                                <div class="form-group">
                                                                        <label for="avatar">Avatar</label>
                                                                        <input name="avatar" type="file" class="form-control-file" id="exampleFormControlFile1">
                                                                </div>
                                                                <div class="form-group">
                                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                                </div>
                                                        </form>
                                            </div>
                                        </div>
                                        <!-- END TABLE HOVER -->
                            </div>
                        </div>
                    </div>
                </div>
        </div>
@endsection