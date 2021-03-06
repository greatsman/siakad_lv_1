@extends('layouts.master')

@section('content')
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
                         @if (session('eror'))
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <i class="fa fa-check-circle"></i> {{session('eror')}}
                            </div>
                         @endif
                        <div class="panel panel-profile">
                            <div class="clearfix">
                                <!-- LEFT COLUMN -->
                                <div class="profile-left">
                                    <!-- PROFILE HEADER -->
                                    <div class="profile-header">
                                        <div class="overlay"></div>
                                        <div class="profile-main">
                                        <img src="{{$data_siswa->getAvatar()}}" height="90" width="90" class="img-circle" alt="Avatar">
                                            <h3 class="name">{{ $data_siswa->nama_depan }}</h3>
                                            <span class="online-status status-available">Available</span>
                                        </div>
                                        <div class="profile-stat">
                                            <div class="row">
                                                <div class="col-md-4 stat-item">
                                                    {{ $data_siswa->mapel->count() }} <span>Mata Pelajaran</span>
                                                </div>
                                                <div class="col-md-4 stat-item">
                                                    {{ $data_siswa->rataRataNilai() }} <span>Rata Rata Nilai</span>
                                                </div>
                                                <div class="col-md-4 stat-item">
                                                    2174 <span>Points</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END PROFILE HEADER -->
                                    <!-- PROFILE DETAIL -->
                                    <div class="profile-detail">
                                        <div class="profile-info">
                                            <h4 class="heading">Biodata</h4>
                                            <ul class="list-unstyled list-justify">
                                                @if ($data_siswa->jenis_kelamin == 'L')
                                                    <li>Jenis Kelamin <span>Laki-Laki</span></li>
                                                @else
                                                    <li>Jenis Kelamin <span>Perempuan</span></li>
                                                @endif
                                                <li>Agama <span>{{$data_siswa->agama}}</span></li>
                                                <li>Alamat <span>{{$data_siswa->alamat}}</span></li>
                                            </ul>
                                        </div>
                                        <div class="text-center"><a href="/siswa/edit/{{$data_siswa -> id}}" class="btn btn-primary">Edit Profile</a></div>
                                    </div>
                                    <!-- END PROFILE DETAIL -->
                                </div>
                                <!-- END LEFT COLUMN -->
                                <!-- RIGHT COLUMN -->
                                <div class="profile-right">
                                    <!-- TABLE STRIPED -->
                                    <div class="panel">
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Tambah Nilai</button>
                                            <div class="panel-heading">
                                                <h3 class="panel-title">Mata Pelajaran</h3>
                                            </div>
                                            <div class="panel-body">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>NO</th>
                                                            <th>KODE</th>
                                                            <th>NAMA MAPEL</th>
                                                            <th>SEMESTER</th>
                                                            <th>GURU</th>
                                                            <th>NILAI</th>
                                                            <th>AKSI</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($data_siswa->mapel as $mapel)
                                                        <tr>
                                                            <td>{{$loop->iteration}}</td>
                                                            <td>{{ $mapel -> kode }}</td>
                                                            <td>{{ $mapel -> nama }}</td>
                                                            <td>{{ $mapel -> semester }}</td>
                                                            <td><a href="/guru/profile/{{ $mapel -> guru -> id }}">{{ $mapel -> guru -> nama }}</a></td>
                                                            <td>{{ $mapel -> pivot -> nilai }}</td>
                                                            <td>
                                                                <a href="/siswa/deletenilai/{{$data_siswa -> id}}/{{$mapel -> id}}" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda akan menghapus')">
                                                                    <i class="fa fa-trash"></i> Hapus
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                    </div>
                                        <!-- END TABLE STRIPED -->
                                    <div class="panel">
                                        <div id="ChartNilai"></div>
                                    </div>
                                </div>
                                        <!-- END RIGHT COLUMN -->
                                    </div>
                                    {{-- Chart Tabel --}}
    
                                    
                        </div>
                    </div>
                </div>
                <!-- END MAIN CONTENT -->
            </div>
            <!-- END MAIN -->
@endsection
{{-- Modal --}}
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Nilai</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="/siswa/addnilai/{{$data_siswa->id}}" method="POST" enctype="multipart/form-data">
            <div class="modal-body">
                    {{ csrf_field() }}
                    <div class="form-group">
                    <label for="mapel">Mata Pelajaran</label>
                        <select class="form-control" id="mapel" name="mapel_id">
                            @foreach ($data_mapel as $data_mapel)
                                <option value="{{$data_mapel->id}}">{{ $data_mapel->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group {{$errors->has('nilai') ? 'has-error':''}}">
                        <label for="nilai">Nilai</label>
                        <input type="text" class="form-control" name="nilai" placeholder="Nilai" value="{{old('nilai')}}">
                    </div>
                    @if ($errors->has('nilai'))
                        <span class="help-block">{{ $errors->first('nilai') }}</span>
                    @endif
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
        </div>
    </div>
</div>
{{--  --}}

@section('script')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script>
        Highcharts.chart('ChartNilai', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Laporan Nilai Siswa'
            },
            xAxis: {
                categories: {!!json_encode($nama_pelajaran)!!},
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Nilai'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Nilai',
                data: {!!json_encode($nilai)!!},

            }]
        });
    </script>
@endsection
