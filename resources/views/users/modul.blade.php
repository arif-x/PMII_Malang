@extends('layouts.slider')

@section('content')
<div class="">
	<div class="one-line">	
		<h2>Modul</h2>
		<a href="javascript:void(0)" data-toggle="tooltip" data-original-title="Tambah Modul" class="btn btn-primary btn-sm mb-4 addModul">Tambah Modul</a>
	</div>

	<div class="card-columns">
		
		@foreach($modul as $data)
		<div class="card">
			<img src="/img/thumbnail_pdf.png" class="card-img-top" alt="...">
			<div class="card-body text-center">
				<h5>{{ $data->judul_post }}</h5>
				<h5>By: {{ $data->nama_lengkap }}</h5>
				<p style="font-size: 80%" class="text-center">
					@if($data->jenis_post == 1)
					Modul
					@elseif($data->jenis_post == 2)
					Video
					@endif
				</p>
				<a type="button" target="_blank" class="btn btn-primary w-100" href="/module/{{ $data->file }}">Lihat</a>
			</div>
		</div>
		@endforeach
	</div>

	{{ $modul->links() }}

	<div class="modal fade bd-example-modal-lg" id="onModal" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content modal-long">
				<div class="modal-header">
					<h4 class="modal-title" id="onModalHeading"></h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="modulForm" method="POST" action="/module/add" name="modulForm" class="form-horizontal" enctype="multipart/form-data">
						@csrf

						<input type="hidden" name="post_id" id="post_id" value="">

						<div class="col-md-12">
							<div class="form-group">
								<label class="col-sm-12 control-label">Judul Modul</label>
								<div class="col-sm-12">
									<input type="text" id="judul" name="judul" placeholder="Judul Modul" class="form-control" required>
								</div>
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group">
								<label class="col-sm-12 control-label">Keterangan</label>
								<div class="col-sm-12">
									<input type="text" id="keterangan" name="keterangan" placeholder="Keterangan" class="form-control" required>
								</div>
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group">
								<label class="col-sm-12 control-label">Pilih File</label>
								<div class="col-sm-12">
									<input type="file" id="select_file" name="select_file" placeholder="Pilih File" class="form-control" accept=".pdf" required>
									<small id="optionalFile">Opsional</small>
								</div>
							</div>
						</div>

						<div class="col-md-12">
							<div class="col-sm-12">
								<hr>
							</div>
						</div>

						<div class="col-md-12 mt-4">
							<div class="col-sm-12">
								<button type="submit" class="btn btn-primary" id="saveBtn" value="create" style="width: 100%">Simpan
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>					
		</form>

	</div>
</div>

<script>
	$(function () {		
		$('body').on('click', '.addModul', function () {
			$('#onModalHeading').html("Tambah Modul");
			$('#modulForm').trigger("reset");
			$('#saveBtn').val("add-modul");
			$('#onModal').modal('show');
			$('#optionalFile').hide();
		});
	});
</script>

<script type="text/javascript">
	$('#modules').addClass('active');
</script>
@endsection
