@extends('layouts.kom-slider')

@section('content')

<div class="mt-4">
	<h1 style="margin-botton: 20px;">Rayon</h1>
	<a href="/admin-komisariat/export/rayon" type="button" class="btn btn-primary">Export ke Excel (.xlxs)</a>
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
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- <div class="modal fade" id="addModal" aria-hidden="true">
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
			ajax: "/admin-komisariat/rayon",
			columns: [
			{data: 'DT_RowIndex', name: 'DT_RowIndex'},
			{data: 'nama_rayon', name: 'nama_rayon'},
			{data: 'nama_komisariat', name: 'nama_komisariat'},
			// {data: 'action', name: 'action', orderable: false, searchable: false},
			]
		});
	});
</script>

<script type="text/javascript">
	$('#rayon').addClass('active');
</script>
@endsection