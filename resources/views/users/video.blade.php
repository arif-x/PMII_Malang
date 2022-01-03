@extends('layouts.slider')

@section('content')
<div class="">
	<h2>Video</h2>
	<a href="javascript:void(0)" data-toggle="tooltip" data-original-title="Tambah Modul" class="btn btn-primary btn-sm mb-4 addVideo">Tambah Video</a>

	<div class="card-columns">
		
		@foreach($video as $data)
		<div class="card">
			<img src="/img/thumbnile_video.png" class="card-img-top" alt="...">
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
				<a type="button" target="_blank" class="btn btn-primary w-100" href="/video/{{ $data->file }}">Lihat</a>
			</div>
		</div>
		@endforeach
	</div>

	{{ $video->links() }}

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
					<form id="videoForm" method="POST" action="/video/add" name="videoForm" class="form-horizontal" enctype="multipart/form-data">
						@csrf

						<input type="hidden" name="post_id" id="post_id" value="">

						<div class="col-md-12">
							<div class="form-group">
								<label class="col-sm-12 control-label">Judul Video</label>
								<div class="col-sm-12">
									<input type="text" id="judul" name="judul" placeholder="Judul Video" class="form-control" required>
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
									<input type="file" id="select_file" name="select_file" placeholder="Pilih File" class="form-control" accept=".mp4" required>
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
		$('body').on('click', '.addVideo', function () {
			$('#onModalHeading').html("Tambah Video");
			$('#videoForm').trigger("reset");
			$('#saveBtn').val("add-video");
			$('#onModal').modal('show');
			$('#optionalFile').hide();
		});
	});
</script>

<script type="text/javascript">
	$('#videos').addClass('active');
</script>
@endsection
