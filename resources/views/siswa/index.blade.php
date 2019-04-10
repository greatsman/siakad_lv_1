@extends('layout.master')

@section('content')
{{-- @if (session('sukses')) --}}
<!-- MAIN -->
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
                                        <h3 class="panel-title">Data Siswa</h3>
                                    </div>
                                    <div class="panel-body">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Tambah Siswa</button>
                                        <a href="/siswa/exportexcel" class="btn btn-success">Export xls</a>
                                        <a href="/siswa/exportpdf" class="btn btn-success">Export pdf</a>
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>NAMA DEPAN</th>
                                                    <th>NAMA BELAKANG</th>
                                                    <th>JENIS KELAMIN</th>
                                                    <th>AGAMA</th>
                                                    <th>ALAMAT</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data_siswa as $data_siswa)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{ $data_siswa -> nama_depan }}</td>
                                                    <td>{{ $data_siswa -> nama_belakang }}</td>
                                                    <td>{{ $data_siswa -> jenis_kelamin }}</td>
                                                    <td>{{ $data_siswa -> agama }}</td>
                                                    <td>{{ $data_siswa -> alamat }}</td>
                                                    <td>
                                                        <a href="/siswa/edit/{{$data_siswa -> id}}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i>Edit</a>
                                                        <a href="#" class="btn btn-danger btn-sm delete" siswa_id="{{$data_siswa -> id}}">
                                                            <i class="fa fa-trash"></i> Hapus
                                                        </a>
                                                        <a  href="/siswa/profile/{{$data_siswa -> id}}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> Lihat</a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- END TABLE HOVER -->
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection

 

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <form action="/siswa/create" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="modal-body">
                <div class="form-group {{$errors->has('nama_depan') ? 'has-error':''}}">
                    <label for="nama_depan">Nama Depan</label>
                    <input type="text" class="form-control" name="nama_depan" placeholder="Nama Depan" value="{{old('nama_depan')}}">
                </div>
                @if ($errors->has('nama_depan'))
                    <span class="help-block">{{ $errors->first('nama_depan') }}</span>
                @endif
                <div class="form-group {{$errors->has('nama_belakang') ? 'has-error':''}}">
                    <label for="nama_belakang">Nama Belakang</label>
                    <input type="text" class="form-control" name="nama_belakang" placeholder="Nama Belakang" value="{{old('nama_belakang')}}">
                </div>
                @if ($errors->has('nama_belakang'))
                    <span class="help-block">{{ $errors->first('nama_belakang') }}</span>
                @endif
                <div class="form-group {{$errors->has('email') ? 'has-error':''}}">
                    <label for="exampleInputEmail1">Email</label>
                    <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email" value="{{old('email')}}">
                </div>
                @if ($errors->has('email'))
                    <span class="help-block">{{ $errors->first('email') }}</span>
                @endif
                <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select class="form-control" name="jenis_kelamin">
                        <option value="L" {{old('jenis_kelamin')=='L' ? 'selected':''}}>Laki-Laki</option>
                        <option value="P" {{old('jenis_kelamin')=='P' ? 'selected':''}}>Perempuan</option>
                        </select>
                </div>
                <div class="form-group {{$errors->has('agama') ? 'has-error':''}}">
                        <label for="agama">Agama</label>
                        <input type="text" class="form-control" name="agama" placeholder="Agama" value="{{old('agama')}}">
                </div>
                @if ($errors->has('agama'))
                    <span class="help-block">{{ $errors->first('agama') }}</span>
                @endif
                <div class="form-group {{$errors->has('alamat') ? 'has-error':''}}">
                        <label for="alamat">Alamat</label>
                        <textarea class="form-control" name="alamat" rows="3">{{old('alamat')}}</textarea>
                </div>
                @if ($errors->has('alamat'))
                    <span class="help-block">{{ $errors->first('alamat') }}</span>
                @endif
                <div class="form-group {{$errors->has('avatar') ? 'has-error':''}}">
                        <label for="avatar">Avatar</label>
                        <input name="avatar" type="file" class="form-control-file" id="exampleFormControlFile1">
                </div>
                @if ($errors->has('avatar'))
                    <span class="help-block">{{ $errors->first('avatar') }}</span>
                @endif
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
    </div>
    </div>
</div>

@section('script')
	<script>
		$('.delete').click(function(){
            var siswa_id = $(this).attr('siswa_id');
            swal({
            title: "Hapus?",
            text: "Data siswa "+siswa_id+" akan di hapus!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                window.location = "/siswa/delete/"+siswa_id;
            } else {
                swal("Proses Dibatalkan");
            }
            });
        })
	</script>
@endsection