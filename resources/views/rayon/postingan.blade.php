@extends('layouts.rayon-slider')

@section('content')

<div class="mt-4">
	<h1 style="margin-bottom: 20px;">Postingan</h1>
	<a href="/admin-rayon/export/post" type="button" class="btn btn-primary">Export ke Excel (.xlxs)</a>
	<br>

	<div style="width: 100%">
		<div class="">
			<table class="table table-bordered data-table table-responsive" style="width: 100% !important">
				<thead>
					<tr>
						<th width="5%">No</th>
						<th width="">Judul Post</th>
						<th width="">Jenis Post</th>
						<th width="">Tanggal Post</th>
						<th width="">Uploader</th>
						<th width="">Detail</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>	
		</div>
	</div>
</div>


<script type="text/javascript">
	$(function () {
		$('.data-tables').hide();
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		var table = $('.data-table').DataTable({
			processing: true,
			serverSide: true,
			ajax: "/admin-rayon/postingan",
			columns: [
			{data: 'DT_RowIndex', name: 'DT_RowIndex'},
			{data: 'judul_post', name: 'judul_post'},
			{data: 'jenis', name: 'jenis'},
			{data: 'tanggal_post', name: 'tanggal_post'},
			{data: 'nama_lengkap', name: 'nama_lengkap'},
			{data: 'detail', name: 'detail', orderable: false, searchable: false},
			]
		});
	});
</script>

<script type="text/javascript">
	$('#postingan').addClass('active');
</script>
@endsection