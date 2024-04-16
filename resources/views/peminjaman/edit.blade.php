<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Peminjaman</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
	<link rel="stylesheet" href="/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
	<link rel="stylesheet" href="/assets/css/ready.css">
	<link rel="stylesheet" href="/assets/css/demo.css">
</head>

<body>
	<div class="wrapper">
		<div class="main-header">
			<div class="logo-header">
				<a class="logo">
					Penggunaan Ruang
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<button class="topbar-toggler more"><i class="la la-ellipsis-v"></i></button>
			</div>
			<nav class="navbar navbar-header navbar-expand-lg">
				<div class="container-fluid">
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						<li class="nav-item dropdown">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" aria-expanded="false"> <img src="{{asset('img')}}/{{ Auth::user()->foto }}" alt="user-img" width="45" height="45" class="img-circle"><span>{{ Auth::user()->name }}</span></span> </a>
							<ul class="dropdown-menu dropdown-user">
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="{{url('/use')}}"><i class="ti-settings"></i> Profil</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item"><i class="fa fa-power-off"></a>
								<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
									{{ __('Logout') }}
								</a>

								<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
									@csrf
								</form>
							</ul>
							<!-- /.dropdown-user -->
						</li>
					</ul>
				</div>
			</nav>
		</div>
		<div class="sidebar">
			<div class="scrollbar-inner sidebar-wrapper">
				<div class="user">
					<img src="../../logo.png" width="60" height="60" class="d-inline-block align-top" alt="">
				</div>
				<ul class="nav">
					<li class="nav-item">
						<a href="{{url('/redirects')}}">
							<i class="la la-dashboard"></i>
							<p>Dashboard</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="{{url('/ruangans')}}">
							<i class="la la-table"></i>
							<p>Ruangan</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="{{url('/penggunaans')}}">
							<i class="la la-keyboard-o"></i>
							<p>Penggunaan Ruang</p>
						</a>
					</li>
					<li class="nav-item active">
						<a href="{{url('/peminjamans')}}">
							<i class="la la-th"></i>
							<p>Peminjaman Ruang</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="{{url('/users')}}">
							<i class="la la-user"></i>
							<p>User</p>
						</a>
					</li>
					<li class="nav-item">
						<a class="" data-toggle="collapse" href="#collapseExample" aria-expanded="true">
							<i class="la la-book"></i>
							<p>Laporan</p> <span class="caret"></span>
						</a>
						<div class="collapse in" id="collapseExample" aria-expanded="true">
							<ul class="nav">
								<li>
									<a href="{{url('/pengguna')}}">
										<span class="link-collapse">Penggunaan Ruang</span>
									</a>
								</li>
								<li>
									<a href="{{url('/peminjam')}}">
										<span class="link-collapse">Peminjaman Ruang</span>
									</a>
								</li>
							</ul>
					</li>
				</ul>
			</div>
		</div>
		<div class="main-panel">
			<div class="content">
				<div class="container-fluid">

					<div class="row row-card-no-pd mt-4">
						<h4 class="ml-3">Kembalikan Peminjaman</h4>
						<div class="container">
							<div class="row">
								<div class="col-9"></div>
								<h4 class="ml-3">Kembalikan Peminjaman</h4>
								<form action="{{url('peminjamans/'.$peminjaman->id)}}" method="POST">
									@method('PATCH')
									@csrf

									<div class="row ml-5">
										<div class="col-6">
											<div class="form-group ml-5">
												<label for="nim" class="col-form-label">NIM</label>
												<div class="">
													<input type="text" class="form-control @error('nim') is-invalid @enderror" id="nim" name="nim" value="{{ old('nim') ?? $peminjaman->nim }}" readonly>

													@error('nim')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message}}</strong>
													</span>
													@enderror
												</div>
											</div>
										</div>

										<div class="col-6">
											<div class="form-group ml-5">
												<label for="telp" class="col-form-label">telp</label>
												<div class="">
													<input type="text" class="form-control @error('telp') is-invalid @enderror" id="telp" name="telp" value="{{ old('telp') ?? $peminjaman->telp }}" readonly>
													@error('telp')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
													@enderror
												</div>
											</div>
										</div>
									</div>

									<div class="row ml-5">
										<div class="col-6">
											<div class="form-group ml-5">
												<label for="nama" class="col-form-label">Nama</label>
												<div class="">
													<input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') ?? $peminjaman->nama }}" readonly>
													@error('nama')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
													@enderror
												</div>
											</div>
										</div>

										<div class="col-6">
											<div class="form-group ml-5">
												<label for="tanggal" class="col-form-label">Tanggal</label>
												<div class="">
													<input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" value="{{ old('tanggal') ?? $peminjaman->tanggal }}" readonly>
													@error('tanggal')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
													@enderror
												</div>
											</div>
										</div>
									</div>

									<div class="row ml-5">
										<div class="col-6">
											<div class="form-group ml-5">
												<label for="kelas" class=" col-form-label">Kelas</label>
												<div class="">
													<select class="form-control" name="kelas" id="kelas" readonly>
														<option value="MI">MI</option>
														<option value="AKM">AKM</option>
														<option value="TOE">TOE</option>
													</select>

													@error('kelas')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
													@enderror
												</div>
											</div>
										</div>
										<div class="col-6">
											<div class="form-group ml-5">
												<label for="jam_masuk" class="col-form-label">jam_masuk</label>
												<div class="">
													<input type="time" class="form-control @error('jam_masuk') is-invalid @enderror" id="jam_masuk" name="jam_masuk" value="{{ old('jam_masuk') ?? $peminjaman->jam_masuk }}" readonly>
													@error('jam_masuk')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
													@enderror
												</div>
											</div>
										</div>
									</div>

									<div class="row ml-5">
										<div class="col-6">
											<div class="form-group ml-5">
												<label for="keperluan" class="col-form-label">Keperluan</label>
												<div class="">
													<input type="text" class="form-control @error('keperluan') is-invalid @enderror" id="keperluan" name="keperluan" value="{{ old('keperluan') ?? $peminjaman->keperluan }}" readonly>
													@error('keperluan')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
													@enderror
												</div>
											</div>
										</div>

										<div class="col-6">
											<div class="form-group ml-5">
												<label for="jam_keluar" class="col-form-label">jam_keluar</label>
												<div class="">
													<input type="time" class="form-control @error('jam_keluar') is-invalid @enderror" id="jam_keluar" name="jam_keluar" value="{{ old('jam_keluar') ?? $peminjaman->jam_keluar }}" readonly>
													@error('jam_keluar')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
													@enderror
												</div>
											</div>
										</div>
									</div>

									<div class="row ml-5">
										<div class="col-6">
											<div class="form-group ml-5">
												<label for="jam_kembali" class="col-form-label">jam_kembali</label>
												<div class="">
													<input type="time" class="form-control @error('jam_kembali') is-invalid @enderror" id="jam_kembali" name="jam_kembali" value="{{ old('jam_kembali')}}">
													@error('jam_kembali')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
													@enderror
												</div>
											</div>
										</div>

										<div class="col-6">

										</div>
									</div>

									<div class="row ml-5">
										<div class="col-6 ml-2">
											<button type="submit" class="btn btn-primary my-2 ml-5 mt-5">Simpan</button>
										</div>
									</div>
								</form>

							</div>

						</div>
					</div>


				</div>
			</div>
		</div>
		<footer class="footer">
			<div class="container-fluid">
			</div>
		</footer>
	</div>
	</div>
	</div>

</body>
<script src="/assets/js/core/jquery.3.2.1.min.js"></script>
<script src="/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="/assets/js/core/popper.min.js"></script>
<script src="/assets/js/core/bootstrap.min.js"></script>
<script src="/assets/js/plugin/chartist/chartist.min.js"></script>
<script src="/assets/js/plugin/chartist/plugin/chartist-plugin-tooltip.min.js"></script>
<script src="/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
<script src="/assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>
<script src="/assets/js/plugin/jquery-mapael/jquery.mapael.min.js"></script>
<script src="/assets/js/plugin/jquery-mapael/maps/world_countries.min.js"></script>
<script src="/assets/js/plugin/chart-circle/circles.min.js"></script>
<script src="/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<script src="/assets/js/ready.min.js"></script>

</html>