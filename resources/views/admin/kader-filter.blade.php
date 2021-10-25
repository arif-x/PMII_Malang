@extends('layouts.admin-slider')

@section('content')

<div class="mt-4">
	<h1 style="margin-bottom: 20px;">Kader</h1>
	<!-- Button trigger modal -->
	<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Filter</button>	
	<a href="/admin/kader/all" type="button" class="btn btn-primary">Reset</a>	
	<br />
	<br />
	<div style="width: 100%">
		<div class="">
			<table class="table table-bordered data-table table-responsive" style="width: 100% !important">
				<thead>
					<tr>
						<th width="5%">No</th>
						<th width="">Nama</th>
						<th width="">Komisariat</th>
						<th width="">Tahun Bergabung</th>
						<th width="">Pekerjaan</th>
						<th width="">No. Telp.</th>
						<th width="">Detail</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>	
		</div>
	</div>
</div>


<div class="">
	<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Filter</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form method="GET" action="/admin/kader/filter">

						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="provinsi" class="col-form-label">Provinsi</label>

									<div class="">
										<select name="provinsi" class="form-control" style="text-transform: uppercase;">
											<option value="">Pilih Provinsi</option>
											@foreach ($provinsi as $key => $value)
											<option value="{{ $key }}">{{ $value }}</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group">
									<label for="kabupaten" class="col-form-label">Kabupaten/Kota</label>

									<div class="">
										<select name="kabupaten" class="form-control" style="text-transform: uppercase;">
											<option value="">Pilih Kabupaten/Kota</option>
										</select>
										<i><small class="form-text text-muted">Pilih provinsi terelebih dahulu</small></i>
									</div>
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group">
									<label for="kecamatan" class="col-form-label">Kecamatan</label>

									<div class="">
										<div class="">
											<select name="kecamatan" class="form-control" style="text-transform: uppercase;">
												<option value="">Pilih Kecamatan</option>
											</select>
											<i><small class="form-text text-muted">Pilih kabupaten terelebih dahulu</small></i>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="statusKawin" class="col-form-label">Status Pernikahan</label>

									<div class="">
										<select class="custom-select @error('statusKawin') is-invalid @enderror" name="statusKawin">
											<option value="">Pilih Status Pernikahan</option>
											<option value="Menikah">Menikah</option>
											<option value="Belum Menikah">Belum Menikah</option>
										</select>
									</div>
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group">
									<label for="pendidikan" class="col-form-label">Pendidikan Terakhir</label>

									<div class="">
										<select name="pendidikan" class="form-control">
											<option value="">Pilih Pendidikan</option>
											@foreach ($pendidikan as $key => $value)
											<option value="{{ $key }}">{{ $value }}</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group">
									<label for="pekerjaan" class="col-form-label">Pekerjaan</label>

									<div class="">
										<select name="pekerjaan" class="form-control @error('pekerjaan') is-invalid @enderror">
											<option value="">Pilih Pekerjaan</option> 
											@foreach ($pekerjaan as $key => $value)
											<option value="{{ $key }}">{{ $value }}</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>
						</div>

						<div class="row">							
							<div class="col-md-4">
								<div class="form-group">
									<label for="komisariatPenyelenggara" class="col-form-label">Komisariat</label>

									<div class="">
										<div class="form-group">                    

											<div class="">
												<select name="komisariatPenyelenggara" class="form-control">
													<option value="">Pilih Komisariat</option>
													@foreach ($komisariat as $key => $value)
													<option value="{{ $key }}">{{ $value }}</option>
													@endforeach
												</select>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group">
									<label for="rayonPenyelenggara" class="col-form-label">Rayon</label>

									<div class="">
										<div class="form-group">                    

											<div class="">
												<select name="rayonPenyelenggara" class="form-control">
													<option value="">Pilih Rayon</option>
												</select>
												<i><small class="form-text text-muted">Pilih komisariat terelebih dahulu</small></i>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group">
									<label for="kaderisasi" class="col-form-label">Kaderisasi Terakhir</label>

									<div class="">
										<select name="kaderisasi" class="form-control">
											<option value="">Pilih Kaderisasi Terakhir</option>
											@foreach ($kaderisasi as $key => $value)
											<option value="{{ $key }}">{{ $value }}</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>
						</div>

						<div class="">
							<label for="tanggalLahir"Mulai class="col-form-label">Tanggal Lahir</label>
							<div class="row">								
								<div class="col-md-4">
									<label for="tanggalLahirMulai"Mulai class="col-form-label">Tanggal Lahir Awal</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text" id="validationTooltipUsernamePrepend" style="background: #3b5998"><i class="fa fa-calendar" style="color: #fff"></i></span>
										</div>
										<input type="date" name="tanggalLahirMulai" class="form-control" id="validationTooltipUsername" placeholder="Tanggal Lahir" class="@error('tampat_lahir') is-invalid @enderror">
									</div>
								</div>

								<div class="col-md-4">
									<label for="tanggalLahirAkhir" class="col-form-label">Tanggal Lahir Akhir</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text" id="validationTooltipUsernamePrepend" style="background: #3b5998"><i class="fa fa-calendar" style="color: #fff"></i></span>
										</div>
										<input type="date" name="tanggalLahirAkhir" class="form-control" id="validationTooltipUsername" placeholder="Tanggal Lahir" class="@error('tampat_lahir') is-invalid @enderror">
									</div>
								</div>

								<div class="col-md-4">
									<div class="form-group">
										<label for="tahun" class="col-form-label">Tahun Bergabung </label>

										<div class="">
											<select name="tahun" class="form-control">
												<option value="">Pilih tahun</option>
												@foreach ($tahun as $key => $value)
												<option value="{{ $key }}">{{ $value }}</option>
												@endforeach
											</select>
										</div>
									</div>
								</div>
							</div>	

							<button type="submit" class="btn btn-primary" style="width: 100%">Proses</button>
						</div>						

					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(function () {
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		var table = $('.data-table').DataTable({
			processing: true,
			serverSide: true,
			ajax: "/admin/kader/filter?provinsi={{app('request')->input('provinsi')}}&kabupaten={{app('request')->input('kabupaten')}}&kecamatan={{app('request')->input('kecamatan')}}&statusKawin={{app('request')->input('statusKawin')}}&pendidikan={{app('request')->input('pendidikan')}}&pekerjaan={{app('request')->input('pekerjaan')}}&komisariatPenyelenggara={{app('request')->input('komisariatPenyelenggara')}}&rayonPenyelenggara={{app('request')->input('rayonPenyelenggara')}}&kaderisasi={{app('request')->input('kaderisasi')}}&tanggalLahirMulai={{app('request')->input('tanggalLahirMulai')}}&tanggalLahirAkhir={{app('request')->input('tanggalLahirAkhir')}}&tahun={{app('request')->input('tahun')}}",
			columns: [
			{data: 'DT_RowIndex', name: 'DT_RowIndex'},
			{data: 'nama_lengkap', name: 'nama_lengkap'},
			{data: 'nama_komisariat', name: 'nama_komisariat'},
			{data: 'tahun_bergabung', name: 'tahun_bergabung'},
			{data: 'pekerjan', name: 'pekerjan'},
			{data: 'no_hp', name: 'no_hp'},
			{data: 'detail', name: 'detail', orderable: false, searchable: false},
			]
		});
	});

	$('select[name="provinsi"]').on('change', function() {
		var kab = $(this).val();
		if(kab) {
			$.ajax({
				url: '/get-kabupaten/'+kab,
				type: "GET",
				dataType: "json",
				success:function(data) {
					$('select[name="kabupaten"]').empty();
					$('select[name="kecamatan"]').empty();
					$.each(data, function(key, value) {
						$('select[name="kabupaten"]').append('<option value="'+ key +'">'+ value +'</option>');
					});
				}
			});
		} else {
			$('select[name="kabupaten"]').empty();                
		}
	});

	$('select[name="kabupaten"]').on('change', function() {
		var kec = $(this).val();
		if(kec) {
			$.ajax({
				url: '/get-kecamatan/'+kec,
				type: "GET",
				dataType: "json",
				success:function(data) {
					$('select[name="kecamatan"]').empty();
					$.each(data, function(key, value) {
						$('select[name="kecamatan"]').append('<option value="'+ key +'">'+ value +'</option>');
					});
				}
			});
		} else {
			$('select[name="kecamatan"]').empty();
		}
	});

	$('select[name="komisariatPenyelenggara"]').on('change', function() {
		var komId = $(this).val();
		if(komId) {
			$.ajax({
				url: '/get-rayon/'+komId,
				type: "GET",
				dataType: "json",
				success:function(data) {
					$('select[name="rayonPenyelenggara"]').empty();
					$.each(data, function(key, value) {
						$('select[name="rayonPenyelenggara"]').append('<option value="'+ key +'">'+ value +'</option>');
					});
				}
			});
		} else {
			$('select[name="rayonPenyelenggara"]').empty();
		}
	});
</script>

<script type="text/javascript">
	$('#kader').addClass('active');
</script>
@endsection