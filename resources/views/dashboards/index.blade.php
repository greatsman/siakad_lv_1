@extends('layouts.master')

@section('content')
    <!-- WRAPPER -->
	<div id="wrapper">
		<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
                    <h3 class="page-title">Halaman Dashboard</h3>
                    {{-- JUMLAH DATA --}}
                    <div class="row">
						<div class="col-md-12">
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Jumlah Data</h3>
								</div>
								<div class="panel-body">
									<div class="col-md-3">
                                        <div class="metric">
                                            <span class="icon"><i class="fa fa-user"></i></span>
                                            <p>
                                                <span class="number">{{ jumlahGuru() }}</span>
                                                <span class="title">Guru</span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="metric">
                                            <span class="icon"><i class="fa fa-user"></i></span>
                                            <p>
                                                <span class="number">{{ jumlahSiswa() }}</span>
                                                <span class="title">Siswa</span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                            <div class="metric">
                                                <span class="icon"><i class="fa fa-book"></i></span>
                                                <p>
                                                    <span class="number">{{ jumlahMapel() }}</span>
                                                    <span class="title">Mapel</span>
                                                </p>
                                            </div>
                                        </div>
								</div>
							</div>
						</div>
                    </div>
                    {{-- END JUMLAH DATA --}}
                    {{-- TABEL RANGKING SISWA --}}
					<div class="row">
						<div class="col-md-6">
							<!-- BORDERED TABLE -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Tabel Rangking Siswa</h3>
								</div>
								<div class="panel-body">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th>No</th>
												<th>Nama</th>
												<th>Nilai</th>
											</tr>
										</thead>
										<tbody>
                                            @php
                                                $ranking = 1;
                                            @endphp
                                            @foreach (ranking5besar() as $ranking_ke)
                                                <tr>
                                                    <td>{{ $ranking }}</td>
                                                    <td>{{ $ranking_ke->nama_lengkap() }}</td>
                                                    <td>{{ $ranking_ke->rataRataNilai() }}</td>
                                                </tr>
                                            @endforeach
                                            @php
                                                $ranking++;
                                            @endphp
										</tbody>
									</table>
								</div>
							</div>
							<!-- END BORDERED TABLE -->
						</div>
                    </div>
                    {{-- END TABEL RANGKING SISWA --}}
				</div>
			</div>
			<!-- END MAIN CONTENT -->
		</div>
		<!-- END MAIN -->
		<div class="clearfix"></div>
		<footer>
			<div class="container-fluid">
				<p class="copyright">&copy; 2017 <a href="https://www.themeineed.com" target="_blank">Theme I Need</a>. All Rights Reserved.</p>
			</div>
		</footer>
	</div>
	<!-- END WRAPPER -->
@endsection