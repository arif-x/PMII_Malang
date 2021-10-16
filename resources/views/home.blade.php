@extends('layouts.slider')

@section('content')


<div class="mt-5">
	<h2>Modul</h2>
	<div class="place__container-post container-post grid">
		@foreach($moduls as $data)
		<div class="place__card">
			<img src="assets/img/place1.jpg" alt="" class="place__img">

			<div class="place__content">
				<span class="place__rating">						
				</span>

				<div class="place__data">
					<h3 class="place__title text-capitalize">{{ $data->judul_post }}</h3>
					@if($data->jenis_post == 1)
					<span class="place__subtitle">Modul</span>
					@elseif($data->jenis_post == 2)
					<span class="place__subtitle">Video</span>
					@endif
					<span class="place__price  text-capitalize">Oleh: {{ $data->nama_lengkap }}</span>
					<span class="place__price"><a target="_blank" class="text-white" href="/post/modul/{{ $data->file }}.{{ $data->format_post }}">Lihat</a></span>
				</div>
			</div>
		</div>
		@endforeach
	</div>	
</div>

<div class="mt-5">
	<h2>Video</h2>
	<div class="place__container-post container-post grid">
		@foreach($videos as $data)
		<div class="place__card">
			<img src="assets/img/place1.jpg" alt="" class="place__img">

			<div class="place__content">
				<span class="place__rating">						
				</span>

				<div class="place__data">
					<h3 class="place__title text-capitalize">{{ $data->judul_post }}</h3>
					@if($data->jenis_post == 1)
					<span class="place__subtitle">Modul</span>
					@elseif($data->jenis_post == 2)
					<span class="place__subtitle">Video</span>
					@endif
					<span class="place__price  text-capitalize">Oleh: {{ $data->nama_lengkap }}</span>
					<span class="place__price"><a target="_blank" class="text-white" href="/post/modul/{{ $data->file }}.{{ $data->format_post }}">Lihat</a></span>
				</div>
			</div>
		</div>
		@endforeach
	</div>	
</div>


<script type="text/javascript">
	$('#home').addClass('active');
</script>

@endsection
