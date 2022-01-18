@extends('layouts.rayon-slider')

@section('content')

<div class="">
	<h2>Artikel</h2>
	<a href="https://sahabat.or.id/" type="button" class="btn btn-primary">Lihat Semua</a>
	<div class="card-columns mt-3">
		@php
		foreach ($cuk['item_terbaru'] AS $d){
		@endphp
		<div class="card">
			<img src="https://sahabat.or.id/wp-content/uploads/{{ $d['meta_value'] }}" class="card-img-top" alt="...">
			<div class="card-body">
				<div class="name_job text-capitalize text-center mb-1">
					{{mb_strimwidth($d['post_title'], 0, 35, "...")}}					
				</div>
				<div class="text-center text-capitalize mb-2">
					{{$d['user_login']}}<br>
					<p class="text-center" style="font-size: 80%">
						{{$d['name']}}
					</p>
				</div>
				<a type="button" target="_blank" class="btn btn-primary" href="{{$d['guid']}}" style="width: 100%">Lihat</a>
			</div>
		</div>
		@php } @endphp
	</div>
</div>

<div class="mt-3">
	<h2>Modul</h2>
	<a href="/module" type="button" class="btn btn-primary">Lihat Semua</a>
	<div class="card-columns mt-3">
		@foreach($moduls as $data)
		<div class="card">
			<img src="/img/thumbnail_pdf.png" class="card-img-top" alt="...">
			<div class="card-body text-center">
				<h5>{{ $data->judul_post }}</h5>
				<h5>By: {{ $data->nama_lengkap }}</h5>
				<p style="font-size: 80%" class="text-center">
					@if($data->jenis_post == 1)
					Modul
					@elseif($data->jenis_post == 2)
					Video
					@endif
				</p>
				<a type="button" target="_blank" class="btn btn-primary w-100" href="/module/{{ $data->file }}">Lihat</a>
			</div>
		</div>
		@endforeach
	</div>
</div>

<hr>

<div class="mt-3">
	<h2>Video</h2>
	<a href="/video" type="button" class="btn btn-primary">Lihat Semua</a>
	<div class="card-columns mt-3">
		@foreach($videos as $data)
		<div class="card">
			<img src="/img/thumbnile_video.png" class="card-img-top" alt="...">
			<div class="card-body text-center">
				<h5>{{ $data->judul_post }}</h5>
				<h5>By: {{ $data->nama_lengkap }}</h5>
				<p style="font-size: 80%" class="text-center">
					@if($data->jenis_post == 1)
					Modul
					@elseif($data->jenis_post == 2)
					Video
					@endif
				</p>
				<a type="button" target="_blank" class="btn btn-primary w-100" href="/video/{{ $data->file }}">Lihat</a>
			</div>
		</div>
		@endforeach
	</div>
</div>

<script type="text/javascript">
	$('#home').addClass('active');
</script>

@endsection
