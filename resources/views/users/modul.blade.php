@extends('layouts.slider')

@section('content')
<div class="container mt-5">
	<a href="javascript:void(0)" data-toggle="tooltip" data-original-title="Tambah Modul" class="btn btn-primary btn-sm mb-4 addEvent">Tambah Modul</a>
	<div style="width: 100%">
		<div class="">
			<table class="table stripe row-border order-column data-table table-responsive" style="width: 100% !important">
				<thead>
					<tr>
						<th width="5%">No.</th>
						<th width="20%">Judul Modul</th>
						<th width="10%">Tanggal</th>
						<th width="20%">Keterangan</th>
						<th width="15%">File</th>
						<th width="15%">Preview</th>
						<th width="30%">Atur</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>

			<div class="modal fade bd-example-modal-lg" id="onModalDelete" aria-hidden="true">
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
			</div>

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
			{data: 'postingan', name: 'postingan'},
			{data: 'lihat', name: 'lihat', orderable: false, searchable: false},
			{data: 'action', name: 'action', orderable: false, searchable: false},
			]
		});

		$('body').on('click', '.addEvent', function () {
			$('#onModalHeading').html("Tambah Modul");
			$('#modulForm').trigger("reset");
			$('#saveBtn').val("add-modul");
			$('#onModal').modal('show');
			$('#optionalFile').hide();
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

		$('body').on('click', '.editModul', function () {
			var modul_id = $(this).data('id');
			$.get("{{ route('modul.index') }}" +'/' + modul_id +'/edit', function (data) {
				$('#onModalHeading').html("Edit Modul");
				$('#saveBtn').val("edit-event");
				$('#onModal').modal('show');
				$('#post_id').val(data.id);
				$('#judul').val(data.judul_post);
				$('#keterangan').val(data.keterangan_post);
				$('#optionalFile').show();
			})
		});

		$('body').on('click', '.deleteModul', function () {
			var modul_id = $(this).data('id');
			$.get("{{ route('modul.index') }}" +'/' + modul_id +'/edit', function (data) {
				$('#onModalHeadingDelete').html("Hapus Modul");
				$('#saveBtnDelete').val("delete-modul");
				$('#onModalDelete').modal('show');
				$('#modul_id_delete').val(data.id);
				$('#judul_file').html(data.judul_post);
			})
		});

		$('#saveBtnDelete').click(function (e) {
			var modul_id =$("#modul_id_delete").val();
			e.preventDefault();
			$.ajax({
				data: $('#modulFormDelete').serialize(),
				url: "{{ route('modul.store') }}"+'/'+modul_id,
				type: "DELETE",
				dataType: 'json',
				success: function (data) {
					$('#modulFormDelete').trigger("reset");
					$('#onModalDelete').modal('hide');
					table.draw();
				},
				error: function (data) {
					console.log('Error:', data);
					$('#saveBtnDelete').html('Hapus');
				}
			});
		});       
	});
</script>

<script type="text/javascript">
	$('#modules').addClass('active');
</script>
@endsection
