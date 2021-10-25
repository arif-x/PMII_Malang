@extends('layouts.admin-slider')

@section('content')

<div class="mt-4">
	<h1 style="margin-botton: 20px;">Pendidikan</h1>
	<a class="btn btn-primary" href="javascript:void(0)" id="createBtn" style="padding-botton: 20px;"> Tambah Pendidikan</a>
	<br />
	<br />
	<div style="width: 100%">
		<div class="">
			<table class="table table-bordered data-table table-responsive" style="width: 100% !important">
				<thead>
					<tr>
						<th width="5%">No</th>
						<th width="75%">Nama Pendidikan</th>
						<th width="20%">Atur</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="modal fade" id="addModal" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="addModalHeader"></h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="addForm" name="addForm" class="form-horizontal">
					<input type="hidden" name="pendidikan_id" id="pendidikan_id">
					<div class="form-group">
						<label for="nama" class="col-sm-12 control-label">Nama Pendidikan</label>
						<div class="col-sm-12">
							<input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama" value="" maxlength="50" required="">
						</div>
					</div>

					<div class="col-sm-12">
						<button type="submit" class="btn btn-primary w-100" id="saveBtn" value="create">Simpan
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- <div class="modal fade" id="deleteModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="deleteModalHeader"></h4>
			</div>
			<div class="modal-body">
				<form id="deleteForm" name="deleteForm" class="form-horizontal">
					<input type="hidden" name="pendidikan_id_delete" id="kom-id-delete">
					<div class="container">
						<h5>Ingin Menghapus <strong id="nama-delete"></strong>?</h5>
					</div>

					<div class="col-sm-12">
						<button type="submit" class="btn btn-danger w-100" id="deleteBtn" value="delete">Hapus
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div> -->

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
			ajax: "{{ route('pendidikan.index') }}",
			columns: [
			{data: 'DT_RowIndex', name: 'DT_RowIndex'},
			{data: 'pendidikan', name: 'pendidikan'},
			{data: 'action', name: 'action', orderable: false, searchable: false},
			]
		});
		$('#createBtn').click(function () {
			$('#saveBtn').val("add pendidikan");
			$('#pendidikan_id').val('');
			$('#addForm').trigger("reset");
			$('#addModalHeader').html("Tambah pendidikan");
			$('#addModal').modal('show');
		});

		$('body').on('click', '.edits', function () {
			var pendidikan_id = $(this).data('id');
			$.get("{{ route('pendidikan.index') }}" +'/' + pendidikan_id +'/edit', function (data) {
				$('#addModalHeader').html("Edit pendidikan");
				$('#saveBtn').val("edit pendidikan");
				$('#addModal').modal('show');
				$('#pendidikan_id').val(data.id_pendidikan);
				$('#nama').val(data.pendidikan);
			})
		});

		$('#saveBtn').click(function (e) {
			e.preventDefault();
			$(this).html('Memproses..');
			$.ajax({
				data: $('#addForm').serialize(),
				url: "{{ route('pendidikan.store') }}",
				type: "POST",
				dataType: 'json',
				success: function (data) {
					$('#addForm').trigger("reset");
					$('#addModal').modal('hide');
					$('#saveBtn').html('Simpan');
					table.draw();
				},
				error: function (data) {
					console.log('Error:', data);
					$('#saveBtn').html('Simpan');
				}
			});
		});

		$('body').on('click', '.deletes', function () {
			var pendidikan_id = $(this).data("id");			
			if(confirm("Are You sure want to delete !")){
				$.ajax({
					type: "DELETE",
					url: "{{ route('pendidikan.store') }}"+'/'+pendidikan_id,
					success: function (data) {
						table.draw();
					},
					error: function (data) {
						console.log('Error:', data);
					}
				});
			} else {

			}			
		});

		// $('body').on('click', '.deletes', function () {
		// 	var pendidikan_id = $(this).data('id');
		// 	$.get("{{ route('pendidikan.index') }}" +'/' + pendidikan_id +'/edit', function (data) {
		// 		$('#deleteModalHeader').html("Hapus pendidikan");
		// 		$('#deleteBtn').val("edit kom");
		// 		$('#deleteModal').modal('show');
		// 		$('#kom-id-delete').val(data.id_pendidikan);
		// 		$('#nama-delete').html(data.pendidikan);
		// 	})
		// });

		// $('#deleteBtn').click(function (e) {
		// 	var data = $("#kom-id-delete").val();
		// 	$.ajax({
		// 		type: "DELETE",
		// 		url: "{{ route('pendidikan.store') }}"+'/'+data,
		// 		dataType: 'json',
		// 		success: function (data) {
		// 			table.draw();
		// 		},
		// 		error: function (data) {
		// 			console.log('Error:', data);
		// 		}
		// 	});
		// });
	});
</script>

<script type="text/javascript">
	$('#pendidikan').addClass('active');
</script>
@endsection