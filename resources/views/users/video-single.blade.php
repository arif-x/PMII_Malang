@extends('layouts.slider')

@section('content')
@foreach($videos as $video)
<div class="col-md-12 col-xl-12 middle-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="card rounded">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <img class="img-xs rounded-circle" src="{{ $video->foto_terbaru }}" alt="">                                                  
                            <div class="ml-2">
                                <h4>{{ $video->nama_lengkap }}</h4>
                                <p class="tx-11 text-muted">
                                    @if($video->jenis_post == 1)
                                    video
                                    @elseif($video->jenis_post == 2)
                                    Video
                                    @endif
                                    : {{ $video->tanggal_post }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h4>{{ $video->judul_post }}</h4>
                        <p class="mb-3 tx-14">{{ $video->keterangan_post }}</p>
                        <div style="width: auto; height: auto">
                <video height="100%" width="100%" controls class="video" preload="metadata"><source src="{{ $video->post }}" type="video/mp4" />
                </video>
            </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex post-actions">
                            <form id="he"></form>    
                            <div id="div-0" style="display: none">
                                <a id="kosong" class="d-flex align-items-center text-muted mr-4"><i class="icon-md" data-feather="heart"></i>
                                 <p class="d-none d-md-block ml-2">Simpan</p></a>
                             </div>
                             <div id="div-1" style="display: none">
                                <a id="saveok" class="d-flex align-items-center text-muted mr-4"><i class="icon-md" data-feather="heart"></i>
                                 <p class="d-none d-md-block ml-2">Hapus</p></a>
                             </div>
                             <a href="javascript:;" class="d-flex align-items-center text-muted mr-4">
                                <i class="icon-md" data-feather="message-square"></i>
                                <p class="d-none d-md-block ml-2">Comment</p>
                            </a>
                            <a href="javascript:;" class="d-flex align-items-center text-muted">
                                <i class="icon-md" data-feather="share"></i>
                                <p class="d-none d-md-block ml-2">Share</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

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
