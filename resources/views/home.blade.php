@extends('layouts.slider')

@section('content')

<div class="mt-5">
	<div class="col-md-12">
		<h2>Modul</h2>
	</div>
	<div class="gr">
		<div class="containers">
			@foreach($moduls as $data)
			<div class="box">
				<div class="image">
					<img src="/img/thumbnail_pdf.png" alt="">
				</div>
				<div class="name_job text-capitalize">{{ $data->judul_post }}</div>
				<div class="text-center text-capitalize">
					@if($data->jenis_post == 1)
					Jenis: Modul
					@elseif($data->jenis_post == 2)
					Jenis: Video
					@endif
					<br>By {{ $data->nama_lengkap }}
				</div>
				<div class="btns">
					<a type="button" target="_blank" class="btn btn-primary" href="/post/modul/{{ $data->file }}.{{ $data->format_post }}" style="width: 100%">Lihat</a>
				</div>
			</div>
			@endforeach
		</div>
	</div>
</div>

<hr>

<div class="mt-3">
	<div class="col-md-12">
		<h2>Video</h2>
	</div>
	<div class="gr">
		<div class="containers">
			@foreach($videos as $data)
			<div class="box">
				<div class="image">
					<img src="/img/thumbnile_video.png" alt="">
				</div>
				<div class="name_job text-capitalize">{{ $data->judul_post }}</div>
				<div class="text-center text-capitalize">
					@if($data->jenis_post == 1)
					Jenis: Modul
					@elseif($data->jenis_post == 2)
					Jenis: Video
					@endif
					<br>By {{ $data->nama_lengkap }}
				</div>
				<div class="btns">
					<a type="button" target="_blank" class="btn btn-primary" href="/post/modul/{{ $data->file }}.{{ $data->format_post }}" style="width: 100%">Lihat</a>
				</div>
			</div>
			@endforeach
		</div>
	</div>
</div>

<script type="text/javascript">
	$('#home').addClass('active');
</script>

@endsection
