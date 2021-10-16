@extends('layouts.slider')

@section('content')
<div class="mt-5">
    @foreach($videos as $video)
    <div class="row">
        <div class="col-md-3 text-capitalize">                    
            <img class="img-fluid" src="/storage/foto/{{ $video->foto_terbaru }}">
        </div>
        <div class="col-md-9 text-capitalize">   
            <div class="row">            
                <div class="col-md-11">
                    <h4>
                        <span class="text-left">{{ $video->judul_post }}. Oleh: {{ $video->nama_lengkap }}</span>
                        <form method="POST" action="" hidden>
                            <input type="" name="post" value="{{ $video->id_post }}">
                        </form>
                    </h4>
                </div>
                <div class="col-md-1 text-center text-primary">                    
                    <form id="he"></form>                                   
                    <div id="div-0" style="display: none">
                        <a id="kosong"><i class='bx bx-heart nav__icon text-primary' style="font-size: 4vh"></i><br>
                        Simpan</a>
                    </div>
                    <div id="div-1" style="display: none">
                        <a id="saveok"><i class='bx bxs-heart nav__icon text-primary' style="font-size: 4vh"></i><br>
                        Hapus</a>
                    </div>
                </div>
            </div>
            <p>Tags: {{ $video->jenis }}</p>
            <p>{{ $video->keterangan_post }}</p>            
            <div class="">seh</div>
            <div style="width: auto; height: auto">

                <video height="100%" width="100%" controls class="video" preload="metadata"><source src="/storage/video/{{ $video->file }}.{{ $video->format_post }}" type="video/mp4" />
                </video>

            </div>
        </div>            
    </div>
    @endforeach
</div>

@if($save == "[]")
<script type="text/javascript">
    $('#div-0').css("display", "block");
    $('#div-1').css("display", "none");
</script>
@else
<script type="text/javascript">
    $('#div-1').css("display", "block");
    $('#div-0').css("display", "none");
</script>
@endif

@foreach($videos as $video)
<script type="text/javascript">
    $('#div-2').css("display", "none");
    $('#div-3').css("display", "none");
    $(function () {
        $(document).on("click", "#kosong", function(e) {
            e.preventDefault();
            $.ajax({
                data: $('#he').serialize(),
                url: "/video/save/{{$video->id_post}}",
                type: "GET",
                dataType: 'json',
                success: function (data) {
                    $('#div-0').css("display", "none");
                    $('#div-1').css("display", "block");
                },
                error: function (data) {
                    $('#div-0').css("display", "none");
                    $('#div-1').css("display", "block");
                }
            });
        });

        $(document).on("click", "#saveok", function(e) {
            e.preventDefault();
            $.ajax({
                data: $('#he').serialize(),
                url: "/video/remove/{{$video->id_post}}",
                type: "GET",
                dataType: 'json',
                success: function (data) {
                    $('#div-1').css("display", "none");
                    $('#div-0').css("display", "block");
                },
                error: function (data) {
                    $('#div-1').css("display", "none");
                    $('#div-0').css("display", "block");
                }
            });
        });
    });
</script>
@endforeach

<script type="text/javascript">
    $('#videos').addClass('active');
</script>
@endsection
