@extends('layouts.admin-slider')

@section('content')

<div class="mt-4">
	<h1 style="margin-bottom: 20px;">Postingan</h1>
	<!-- Button trigger modal -->
	<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Filter</button>	
	<br />
	<br />

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
						<th width="">Komisariat</th>
						<th width="">Rayon</th>
						<th width="">Detail</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>	
		</div>
	</div>
</div>


<div class="">
	<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Filter</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form method="GET" action="/admin/postingan/filter">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="komisariat" class="col-form-label">Komisariat</label>
									<div class="">
										<select name="komisariat" class="form-control" style="text-transform: uppercase;">
											<option value="">Pilih Komisariat</option>
											@foreach ($komisariat as $key => $value)
											<option value="{{ $key }}">{{ $value }}</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label for="rayon" class="col-form-label">Rayon</label>
									<div class="">
										<select name="rayon" class="form-control" style="text-transform: uppercase;">
											<option value="">Pilih Rayon</option>
										</select>
									</div>
								</div>
							</div>							
						</div>

						<button type="submit" class="btn btn-primary" style="width:100%">Proses</button>						
					</form>
				</div>
			</div>
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
			ajax: "/admin/postingan/all",
			columns: [
			{data: 'DT_RowIndex', name: 'DT_RowIndex'},
			{data: 'judul_post', name: 'judul_post'},
			{data: 'jenis', name: 'jenis'},
			{data: 'tanggal_post', name: 'tanggal_post'},
			{data: 'nama_lengkap', name: 'nama_lengkap'},
			{data: 'nama_komisariat', name: 'nama_komisariat'},
			{data: 'nama_rayon', name: 'nama_rayon'},
			{data: 'detail', name: 'detail', orderable: false, searchable: false},
			]
		});
	});

	$('select[name="komisariat"]').on('change', function() {
		var komId = $(this).val();
		if(komId) {
			$.ajax({
				url: '/get-rayon/'+komId,
				type: "GET",
				dataType: "json",
				success:function(data) {
					$('select[name="rayon"]').empty();
					$.each(data, function(key, value) {
						$('select[name="rayon"]').append('<option value="'+ key +'">'+ value +'</option>');
					});
				}
			});
		} else {
			$('select[name="rayon"]').empty();
		}
	});
</script>

<script type="text/javascript">
	$('#postingan').addClass('active');
</script>
@endsection