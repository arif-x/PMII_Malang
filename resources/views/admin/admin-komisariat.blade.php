@extends('layouts.admin-slider')

@section('content')

<div class="mt-4">
	<h1 style="margin-botton: 20px;">Admin Komisariat</h1>
	<a class="btn btn-primary" href="javascript:void(0)" id="createBtn" style="padding-botton: 20px;"> Tambah Admin</a>
	<!-- <a href="/admin/export/pekerjaan" type="button" class="btn btn-primary">Export ke Excel (.xlxs)</a> -->
	<br />
	<br />
	<div style="width: 100%">
		<div class="">
			<table class="table table-bordered data-table table-responsive" style="width: 100% !important">
				<thead>
					<tr>
						<th width="5%">No</th>
						<th width="75%">Email</th>
						<th width="75%">Nama Admin</th>
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
					<input type="hidden" name="admin_kom_id" id="admin_kom_id">
					<div class="form-group">
						<label for="nama" class="col-sm-12 control-label">Nama Admin Komisariat</label>
						<div class="col-sm-12">
							<input type="text" class="form-control" id="datas" name="namas" placeholder="Masukkan Nama" value="" maxlength="50" required="">
							<div class="dropdown-menu" id="dropdown-menu">
                            </div>
						</div>
						<input type="hidden" class="form-control" id="id_admin_kom" name="id_admin_kom" placeholder="Masukkan Nama" value="" maxlength="50" required="">
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
					<input type="hidden" name="admin_kom_id_delete" id="kom-id-delete">
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
			ajax: "{{ route('admin-komisariat.index') }}",
			columns: [
			{data: 'DT_RowIndex', name: 'DT_RowIndex'},
			{data: 'email', name: 'email'},
			{data: 'nama_lengkap', name: 'nama_lengkap'},
			{data: 'action', name: 'action', orderable: false, searchable: false},
			]
		});
		$('#createBtn').click(function () {
			$('#saveBtn').val("add admin-komisariat");
			$('#admin_kom_id').val('');
			$('#addForm').trigger("reset");
			$('#addModalHeader').html("Tambah Admin Komisariat");
			$('#addModal').modal('show');
		});

		$('body').on('click', '.edits', function () {
			var admin_kom_id = $(this).data('id');
			$.get("{{ route('admin-komisariat.index') }}" +'/' + admin_kom_id +'/edit', function (data) {
				$('#addModalHeader').html("Edit admin-komisariat");
				$('#saveBtn').val("edit admin-komisariat");
				$('#addModal').modal('show');
			})
		});

		$('#saveBtn').click(function (e) {
			e.preventDefault();
			$(this).html('Memproses..');
			admin_kom_id = $('#id_admin_kom').val();
			$.ajax({
				data: $('#addForm').serialize(),
				url: "/admin/admin-komisariat/tambah/"+admin_kom_id,
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
			var admin_kom_id = $(this).data("id");			
			if(confirm("Are You sure want to delete !")){
				$.ajax({
					type: "POST",
					url: "/admin/admin-komisariat/hapus/"+admin_kom_id,
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
		// 	var admin_kom_id = $(this).data('id');
		// 	$.get("{{ route('admin-komisariat.index') }}" +'/' + admin_kom_id +'/edit', function (data) {
		// 		$('#deleteModalHeader').html("Hapus admin-komisariat");
		// 		$('#deleteBtn').val("edit kom");
		// 		$('#deleteModal').modal('show');
		// 		$('#kom-id-delete').val(data.id_admin-komisariat);
		// 		$('#nama-delete').html(data.pekerjan);
		// 	})
		// });

		// $('#deleteBtn').click(function (e) {
		// 	var data = $("#kom-id-delete").val();
		// 	$.ajax({
		// 		type: "DELETE",
		// 		url: "{{ route('admin-komisariat.store') }}"+'/'+data,
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
	$('#dropdown-menu').fadeIn(); 
	$(document).ready(function(){
		$('#datas').keyup(function(){ 
			var query = $(this).val();
			if(query != ''){
				var _token = $('input[name="_token"]').val();
				$.ajax({
					url:"{{ route('searchUser') }}",
					method:"GET",
					data:{query:query, _token:_token},
					success:function(data){
						$('#dropdown-menu').fadeIn();  
						$('#dropdown-menu').html(data);
					}
				});
			}
		});
		$(document).on('click', '#datadrop', function(){  
			data_id =  $(this).data('id');
			$('#datas').val($(this).text());
			$('#id_admin_kom').val(data_id);
			$('#dropdown-menu').fadeOut();  
		});  
	});
</script>

<style type="text/css">
.box{
	width:600px;
	margin:0 auto;
}
</style>

<script type="text/javascript">
	$('#admin-komisariat').addClass('active');
</script>
@endsection