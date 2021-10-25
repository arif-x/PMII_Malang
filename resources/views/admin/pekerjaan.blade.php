@extends('layouts.admin-slider')

@section('content')

<div class="container mt-4">
	<h1 style="margin-botton: 20px;">Pekerjaan</h1>
	<a class="btn btn-primary" href="javascript:void(0)" id="createBtn" style="padding-botton: 20px;"> Tambah Pekerjaan</a>
	<br />
	<br />
	<table class="table table-bordered data-table">
		<thead>
			<tr>
				<th width="5%">No</th>
				<th width="75%">Nama Pekerjaan</th>
				<th width="20%">Atur</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>

<div class="modal fade" id="addModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="addModalHeader"></h4>
			</div>
			<div class="modal-body">
				<form id="addForm" name="addForm" class="form-horizontal">
					<input type="hidden" name="pekerjan_id" id="pekerjan_id">
					<div class="form-group">
						<label for="nama" class="col-sm-12 control-label">Nama Pekerjaan</label>
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
					<input type="hidden" name="pekerjan_id_delete" id="kom-id-delete">
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
			ajax: "{{ route('pekerjaan.index') }}",
			columns: [
			{data: 'DT_RowIndex', name: 'DT_RowIndex'},
			{data: 'pekerjan', name: 'pekerjan'},
			{data: 'action', name: 'action', orderable: false, searchable: false},
			]
		});
		$('#createBtn').click(function () {
			$('#saveBtn').val("add pekerjaan");
			$('#pekerjan_id').val('');
			$('#addForm').trigger("reset");
			$('#addModalHeader').html("Tambah pekerjaan");
			$('#addModal').modal('show');
		});

		$('body').on('click', '.edits', function () {
			var pekerjan_id = $(this).data('id');
			$.get("{{ route('pekerjaan.index') }}" +'/' + pekerjan_id +'/edit', function (data) {
				$('#addModalHeader').html("Edit pekerjaan");
				$('#saveBtn').val("edit pekerjaan");
				$('#addModal').modal('show');
				$('#pekerjan_id').val(data.id_pekerjan);
				$('#nama').val(data.pekerjan);
			})
		});

		$('#saveBtn').click(function (e) {
			e.preventDefault();
			$(this).html('Memproses..');
			$.ajax({
				data: $('#addForm').serialize(),
				url: "{{ route('pekerjaan.store') }}",
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
			var pekerjan_id = $(this).data("id");			
			if(confirm("Are You sure want to delete !")){
				$.ajax({
					type: "DELETE",
					url: "{{ route('pekerjaan.store') }}"+'/'+pekerjan_id,
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
		// 	var pekerjan_id = $(this).data('id');
		// 	$.get("{{ route('pekerjaan.index') }}" +'/' + pekerjan_id +'/edit', function (data) {
		// 		$('#deleteModalHeader').html("Hapus pekerjaan");
		// 		$('#deleteBtn').val("edit kom");
		// 		$('#deleteModal').modal('show');
		// 		$('#kom-id-delete').val(data.id_pekerjaan);
		// 		$('#nama-delete').html(data.pekerjan);
		// 	})
		// });

		// $('#deleteBtn').click(function (e) {
		// 	var data = $("#kom-id-delete").val();
		// 	$.ajax({
		// 		type: "DELETE",
		// 		url: "{{ route('pekerjaan.store') }}"+'/'+data,
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
	$('#pekerjaan').addClass('active');
</script>
@endsection