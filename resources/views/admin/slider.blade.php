@extends('layouts.admin-slider')

@section('content')

<div class="mt-4">
	<h1 style="margin-botton: 20px;">Slider</h1>
	<a class="btn btn-primary" href="javascript:void(0)" id="createBtn" style="padding-botton: 20px;"> Tambah Slider</a>
	<br />
	<br />
	<div style="width: 100%">
		<div class="">
			<table class="table table-bordered data-table table-responsive" style="width: 100% !important">
				<thead>
					<tr>
						<th width="5%">No</th>
						<th width="">Gambar</th>
						<th width="">Atur</th>
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
					<input type="hidden" name="slider_id" id="slider_id">

					<div class="form-group">
						<label for="image" class="col-sm-12 control-label">Gambar</label>
						<div class="col-sm-12">
							<input type="file" class="form-control" id="image" name="image" placeholder="Masukkan Nama" value="" maxlength="50" required>
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
					<input type="hidden" name="slider_id_delete" id="kom-id-delete">
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
			ajax: "/admin/slider",
			columns: [
			{data: 'DT_RowIndex', name: 'DT_RowIndex'},
			{data: 'images', name: 'images', orderable: false, searchable: false},
			{data: 'action', name: 'action', orderable: false, searchable: false},
			]
		});
		$('#createBtn').click(function () {
			$('#saveBtn').val("add Slider");
			$('#slider_id').val('');
			$('#gambar').val('');
			$('#addForm').trigger("reset");
			$('#addModalHeader').html("Tambah Slider");
			$('#addModal').modal('show');			
		});

		$('body').on('click', '.edits', function () {
			var slider_id = $(this).data('id');
			$.get("/admin/slider" +'/' + slider_id +'/edit', function (data) {
				$('#addModalHeader').html("Edit Slider");
				$('#saveBtn').val("edit Slider");
				$('#addModal').modal('show');
				$('#slider_id').val(data[0].id_slider);
			})
		});

		$('#saveBtn').click(function (e) {
			e.preventDefault();
			$(this).html('Memproses..');
			$.ajax({
				data: new FormData($("#addForm")[0]),
				url: "/admin/slider",
				type: "POST",
				cache:false,
				contentType: false,
				processData: false,
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
			var slider_id = $(this).data("id");			
			if(confirm("Are You sure want to delete !")){
				$.ajax({
					type: "DELETE",
					url: "/admin/slider"+'/'+slider_id,
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
	});
</script>

<script type="text/javascript">
	$('#Slider').addClass('active');
</script>

@endsection