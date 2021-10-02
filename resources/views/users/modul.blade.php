@extends('layouts.slider')

@section('content')
<div class="container mt-5">
	<a href="javascript:void(0)" data-toggle="tooltip" data-original-title="Tambah Modul" class="btn btn-primary btn-sm mb-4 addEvent">Tambah Modul</a>
	<div style="width: 100%">
		<div class="">
			<table class="table stripe row-border order-column data-table table-responsive" style="width: 100% !important">
				<thead>
					<tr>
						<th>No.</th>
						<th>Judul Modul</th>
						<th>Tanggal</th>
						<th>Keterangan</th>
						<th>File</th>
						<th>Format</th>
						<th width="280px">Atur</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>

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
							<form id="modulForm" action="javascript:;" name="modulForm" class="form-horizontal" enctype="multipart/form-data">
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
											<input type="file" id="select_file" name="select_file" placeholder="Pilih File" class="form-control" required>
										</div>
									</div>
									<!-- <div class="input-group">
										<label class="col-sm-12 control-label">Pilih File</label>
										<div class="col-sm-12">
											<a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary text-white" type="button" style="width:100% !important">
												<i class="fa fa-picture-o"></i> Pilih File
											</a>
										</div>
										<input id="thumbnail" class="form-control" type="hidden" name="filepath">
									</div> -->
									<!-- <div class="text-center">
										<div id="holder" style="margin-top:15px;margin-bottom:15px;height:auto;"></div> 
									</div> -->
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
	</div>
</div>

<script>
	$(function () {
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		var table = $('.data-table').DataTable({
			processing: true,
			serverSide: true,
			ajax: "{{ route('modul.index') }}",
			columns: [
			{data: 'DT_RowIndex', name: 'DT_RowIndex'},
			{data: 'judul_post', name: 'judul_post'},
			{data: 'tanggal_post', name: 'tanggal_post'},
			{data: 'keterangan_post', name: 'keterangan_post'},
			{data: 'post', name: 'post'},
			{data: 'format_post', name: 'format_post'},
			{data: 'action', name: 'action', orderable: false, searchable: false},
			]
		});

		$('body').on('click', '.addEvent', function () {
			$('#onModalHeading').html("Tambah Modul");
			$('#modulForm').trigger("reset");
			$('#saveBtn').val("add-modul");
			$('#onModal').modal('show');
		});      

		$('#saveBtn').click(function (e) {
			e.preventDefault();

			var form = $('#modulForm')[0];

			var data = new FormData(form)

			$.ajax({
				type: "POST",
				enctype: 'multipart/form-data',
				processData: false,
				contentType: false,
				cache: false,
				data: data,
				url: "{{ route('modul.store') }}",
				// dataType: 'json',
				success: function (data) {
					$('#modulForm').trigger("reset");
					$('#onModal').modal('hide');
					table.draw();
				},
				error: function (data) {
					console.log('Error:', data);
					$('#saveBtn').html('Simpan');
				}
			});
		});
	});
</script>

<script>
	var route_prefix = "/filemanager?type=pdf";
</script>

<script>
	{!! \File::get(base_path('vendor/unisharp/laravel-filemanager/public/js/stand-alone-button.js')) !!}
</script>
<script>
	$('#lfm').filemanager();
</script>

<style type="text/css">
	#holder p {
		font-weight: bold;
	}
</style>

<script type="text/javascript">
	$('#modules').addClass('active');
</script>
@endsection
