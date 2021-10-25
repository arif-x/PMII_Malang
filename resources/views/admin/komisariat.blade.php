@extends('layouts.admin-slider')

@section('content')

<div class="mt-4">
	<h1 style="margin-botton: 20px;">Komisariat</h1>
	<a class="btn btn-primary" href="javascript:void(0)" id="createBtn" style="padding-botton: 20px;"> Tambah Komisariat</a>
	<br />
	<br />
	<div style="width: 100%">
		<div class="">
			<table class="table table-bordered data-table table-responsive" style="width: 100% !important">
				<thead>
					<tr>
						<th width="5%">No</th>
						<th width="75%">Nama Komisariat</th>
						<th width="20%">Atur</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
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
						<input type="hidden" name="kom_id" id="kom_id">
						<div class="form-group">
							<label for="nama" class="col-sm-12 control-label">Nama Komisariat</label>
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

	<div class="modal fade" id="deleteModal" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="deleteModalHeader"></h4>
				</div>
				<div class="modal-body">
					<form id="deleteForm" name="deleteForm" class="form-horizontal">
						<input type="hidden" name="kom_id_delete" id="kom-id-delete">
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
			ajax: "{{ route('komisariat.index') }}",
			columns: [
			{data: 'DT_RowIndex', name: 'DT_RowIndex'},
			{data: 'nama_komisariat', name: 'nama_komisariat'},
			{data: 'action', name: 'action', orderable: false, searchable: false},
			]
		});
		$('#createBtn').click(function () {
			$('#saveBtn').val("add kom");
			$('#kom_id').val('');
			$('#addForm').trigger("reset");
			$('#addModalHeader').html("Tambah Komisariat");
			$('#addModal').modal('show');
		});

		$('body').on('click', '.edits', function () {
			var kom_id = $(this).data('id');
			$.get("{{ route('komisariat.index') }}" +'/' + kom_id +'/edit', function (data) {
				$('#addModalHeader').html("Edit Komisariat");
				$('#saveBtn').val("edit kom");
				$('#addModal').modal('show');
				$('#kom_id').val(data.id_komisariat);
				$('#nama').val(data.nama_komisariat);
			})
		});

		$('#saveBtn').click(function (e) {
			e.preventDefault();
			$(this).html('Memproses..');
			$.ajax({
				data: $('#addForm').serialize(),
				url: "{{ route('komisariat.store') }}",
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
			var kom_id = $(this).data("id");			
			if(confirm("Are You sure want to delete !")){
				$.ajax({
					type: "DELETE",
					url: "{{ route('komisariat.store') }}"+'/'+kom_id,
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
		// 	var kom_id = $(this).data('id');
		// 	$.get("{{ route('komisariat.index') }}" +'/' + kom_id +'/edit', function (data) {
		// 		$('#deleteModalHeader').html("Hapus Komisariat");
		// 		$('#deleteBtn').val("edit kom");
		// 		$('#deleteModal').modal('show');
		// 		$('#kom-id-delete').val(data.id_komisariat);
		// 		$('#nama-delete').html(data.nama_komisariat);
		// 	})
		// });

		// $('#deleteBtn').click(function (e) {
		// 	var data = $("#kom-id-delete").val();
		// 	$.ajax({
		// 		type: "DELETE",
		// 		url: "{{ route('komisariat.store') }}"+'/'+data,
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
	$('#komisariat').addClass('active');
</script>
@endsection