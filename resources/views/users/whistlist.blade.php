@extends('layouts.slider')

@section('content')
<div class="mt-5">
    <div class="col-md-12">
        <h2>Disimpan</h2>
    </div>
    <div class="gr">
        <div class="containers">
            @foreach($wlist as $data)
            <div class="box">
                <div class="image">
                    @if($data->jenis_post == 1)
                    <img src="/img/thumbnail_pdf.png" alt="">
                    @elseif($data->jenis_post == 2)
                    <img src="/img/thumbnile_video.png" alt="">
                    @endif
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
</div>

<script type="text/javascript">
    $('#wlist').addClass('active');
</script>
@endsection
