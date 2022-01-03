@extends('layouts.slider')

@section('content')
<div class="">
    <h2>Disimpan</h2>
    <div class="card-columns mt-3">
        @foreach($wlist as $data)
        <div class="card">
            @if($data->jenis_post == 1)
            <img src="/img/thumbnail_pdf.png" class="card-img-top" alt="...">
            @elseif($data->jenis_post == 2)
            <img src="/img/thumbnail_pdf.png" class="card-img-top" alt="...">
            @endif
            <div class="card-body">
                <div class="text-center text-capitalize">
                    <h5>{{ $data->judul_post }}</h5>
                    <h5>By {{ $data->nama_lengkap }}</h5>
                    @if($data->jenis_post == 1)
                    Jenis: Modul
                    @elseif($data->jenis_post == 2)
                    Jenis: Video
                    @endif
                </div>
                @if($data->jenis_post == 1)
                <a type="button" target="_blank" class="btn btn-primary" href="/module/{{$data->file}}.{{$data->format_post}}" style="width: 100%">Lihat</a>
                @elseif($data->jenis_post == 2)
                <a type="button" target="_blank" class="btn btn-primary" href="/video/{{$data->file}}.{{$data->format_post}}" style="width: 100%">Lihat</a>
                @endif
            </div>
        </div>
        @endforeach
    </div>
</div>

<script type="text/javascript">
    $('#wlist').addClass('active');
</script>
@endsection
