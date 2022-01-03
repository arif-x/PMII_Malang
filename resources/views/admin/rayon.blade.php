@extends('layouts.admin-slider')

@section('content')

<div class="mt-4">
	<h1 style="margin-botton: 20px;">Rayon</h1>
	<a class="btn btn-primary" href="javascript:void(0)" id="createBtn" style="padding-botton: 20px;"> Tambah Rayon</a>
	<a href="/admin/export/rayon" type="button" class="btn btn-primary">Export ke Excel (.xlxs)</a>
	<br />
	<br />
	<div style="width: 100%">
		<div class="">
			<table class="table table-bordered data-table table-responsive" style="width: 100% !important">
				<thead>
					<tr>
						<th width="5%">No</th>
						<th width="40%">Nama Rayon</th>
						<th width="35%">Nama Komisariat</th>
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
					<input type="hidden" name="rayon_id" id="rayon_id">
					<div class="form-group">
						<label for="nama" class="col-sm-12 control-label">Nama Rayon</label>
						<div class="col-sm-12">
							<input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama" value="" maxlength="50" required="">
						</div>
					</div>

					<div class="form-group">
						<label for="nama" class="col-sm-12 control-label">Nama Komisariat</label>
						<div class="col-sm-12">
							<select name="komisariat" class="form-control" id="koms">
								<option id="selected" value="">Pilih</option>
								@foreach ($komisariat as $key => $value)
								<option value="{{ $key }}">{{ $value }}</option>
								@endforeach
							</select>
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
					<input type="hidden" name="rayon_id_delete" id="kom-id-delete">
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
			ajax: "/admin/rayon",
			columns: [
			{data: 'DT_RowIndex', name: 'DT_RowIndex'},
			{data: 'nama_rayon', name: 'nama_rayon'},
			{data: 'nama_komisariat', name: 'nama_komisariat'},
			{data: 'action', name: 'action', orderable: false, searchable: false},
			]
		});
		$('#createBtn').click(function () {
			$('#saveBtn').val("add rayon");
			$('#rayon_id').val('');
			$('#addForm').trigger("reset");
			$('#addModalHeader').html("Tambah rayon");
			$('#addModal').modal('show');
		});

		$('body').on('click', '.edits', function () {
			var rayon_id = $(this).data('id');
			$.get("/admin/rayon" +'/' + rayon_id +'/edit', function (data) {
				$('#addModalHeader').html("Edit rayon");
				$('#saveBtn').val("edit rayon");
				$('#addModal').modal('show');
				$('#rayon_id').val(data.id_rayon);
				$('#nama').val(data.nama_rayon);				
				$("#koms option:selected").removeAttr('selected');
				$("#koms option[value=" + data.id_komisariat + "]").attr('selected', 'selected');
			})
		});

		$('#saveBtn').click(function (e) {
			e.preventDefault();
			$(this).html('Memproses..');
			$.ajax({
				data: $('#addForm').serialize(),
				url: "{{ route('rayon.store') }}",
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
			var rayon_id = $(this).data("id");			
			if(confirm("Are You sure want to delete !")){
				$.ajax({
					type: "DELETE",
					url: "{{ route('rayon.store') }}"+'/'+rayon_id,
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
		// 	var rayon_id = $(this).data('id');
		// 	$.get("/admin/rayon" +'/' + rayon_id +'/edit', function (data) {
		// 		$('#deleteModalHeader').html("Hapus rayon");
		// 		$('#deleteBtn').val("edit kom");
		// 		$('#deleteModal').modal('show');
		// 		$('#kom-id-delete').val(data.id_rayon);
		// 		$('#nama-delete').html(data.pekerjan);
		// 	})
		// });

		// $('#deleteBtn').click(function (e) {
		// 	var data = $("#kom-id-delete").val();
		// 	$.ajax({
		// 		type: "DELETE",
		// 		url: "{{ route('rayon.store') }}"+'/'+data,
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
	$('#rayon').addClass('active');
</script>
@endsection