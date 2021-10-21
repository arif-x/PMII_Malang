@extends('layouts.slider')

@section('content')

<div class="mt-5">
		<div class="col-md-12 one-line">	
			<h2>Artikel</h2>
			<a href="https://sahabat.or.id/" type="button" class="btn btn-primary">Lihat Semua</a>
		</div>
	<div class="gr">
		<div class="containers">
			@php
			foreach ($cuk['item_terbaru'] AS $d){
			@endphp
			<div class="boxs">
				<div class="div-1">
					<div class="image">
						<img src="https://sahabat.or.id/wp-content/uploads/{{ $d['meta_value'] }}" alt="">
					</div>
				</div>
				<div class="div-2 align-middle">
					<div class="name_job text-capitalize text-center">
						{{mb_strimwidth($d['post_title'], 0, 30, "...")}}					
					</div>
					<div class="text-center text-capitalize">
						{{$d['user_login']}}<br>
						<p class="text-center" style="font-size: 80%">
							{{$d['name']}}
						</p>
					</div>
				</div>
				<div class="btns">
					<a type="button" target="_blank" class="btn btn-primary" href="{{$d['guid']}}" style="width: 100%">Lihat</a>
				</div>
			</div>
			@php
		}
		@endphp
	</div>
</div>
</div>

<div class="mt-3">
	<div class="col-md-12">
		<div class="col-md-12 one-line">	
			<h2>Modul</h2>
			<a href="/module" type="button" class="btn btn-primary">Lihat Semua</a>
		</div>
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
					{{ $data->nama_lengkap }}<br>
					<p style="font-size: 80%" class="text-center">
						@if($data->jenis_post == 1)
						Modul
						@elseif($data->jenis_post == 2)
						Video
						@endif
					</p>
				</div>
				<div class="btns">
					<a type="button" target="_blank" class="btn btn-primary" href="/module/{{ $data->file }}.{{ $data->format_post }}" style="width: 100%">Lihat</a>
				</div>
			</div>
			@endforeach
		</div>
	</div>
</div>

<hr>

<div class="mt-3">
	<div class="col-md-12">
		<div class="col-md-12 one-line">	
			<h2>Video</h2>
			<a href="/video" type="button" class="btn btn-primary">Lihat Semua</a>
		</div>
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
					{{ $data->nama_lengkap }}<br>
					<p style="font-size: 80%" class="text-center">
						@if($data->jenis_post == 1)
						Modul
						@elseif($data->jenis_post == 2)
						Video
						@endif
					</p>
				</div>
				<div class="btns">
					<a type="button" target="_blank" class="btn btn-primary" href="/video/{{ $data->file }}.{{ $data->format_post }}" style="width: 100%">Lihat</a>
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
