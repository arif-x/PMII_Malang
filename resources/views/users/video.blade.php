@extends('layouts.slider')

@section('content')
<div class="mt-5">
	<div class="col-md-12">
		<div class="col-md-12 one-line">	
			<h2>Video</h2>
			<a href="javascript:void(0)" data-toggle="tooltip" data-original-title="Tambah Modul" class="btn btn-primary btn-sm mb-4 addVideo">Tambah Video</a>
		</div>
	</div>

	<div class="gr">
		<div class="containers">
			@foreach($video as $data)
			<div class="box">
				<div class="image">
					<img src="/img/thumbnile_video.png" alt="">
				</div>
				<div class="name_job text-capitalize">{{ $data->judul_post }}</div>
				<div class="text-center text-capitalize">					
					{{ $data->nama_lengkap }}<br>
					<p style="font-size: 80%" class="text-center">
						@if($data->jenis_post == 1)
						Modul
						@elseif($data->jenis_post == 2)
						Video
						@endif
					</p>
				</div>
				<div class="btns">
					<a type="button" target="_blank" class="btn btn-primary" href="/video/{{ $data->file }}.{{ $data->format_post }}" style="width: 100%">Lihat</a>
				</div>
			</div>
			@endforeach
		</div>
	</div>

	{{ $video->links() }}

	<!-- <div class="modal fade bd-example-modal-lg" id="onModalDelete" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content modal-long">
				<div class="modal-header">
					<h4 class="modal-title" id="onModalHeadingDelete"></h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="modulFormDelete" name="modulFormDelete" class="form-horizontal">
						<input type="hidden" name="modul_id_delete" id="modul_id_delete" value="">

						<div class="col-md-12">

							<h4>Ingin Menghapus Modul <strong id="judul_file"></strong>?</h4>

						</div>
						<div class="col-md-12">
							<button type="submit" class="btn btn-info" id="saveBtnDelete" value="delete" style="width: 100%">Hapus
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div> -->

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
