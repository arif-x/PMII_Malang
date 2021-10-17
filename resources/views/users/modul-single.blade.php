@extends('layouts.slider')

@section('content')
<div class="mt-5">
    @foreach($moduls as $modul)
    <div class="row">
        <div class="col-md-3 text-capitalize mb-3 text-center">                    
            <img class="img-fluid" style="max-width: 65%" src="/storage/foto/{{ $modul->foto_terbaru }}">
        </div>
        <div class="col-md-9 text-capitalize">   
            <div class="row">                            
                <div class="col-md-10">
                    <h4>
                        <span class="text-left">{{ $modul->judul_post }}. Oleh: {{ $modul->nama_lengkap }}</span>
                    </h4>
                </div>                
                <div class="col-md-2 text-center text-primary">     
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
            <p>Tags: {{ $modul->jenis }}</p>
            <p>{{ $modul->keterangan_post }}</p>            
        </div>
        <div class="col-md-12 mt-4">
            <div class="embed-responsive embed-responsive-1by1">
                <embed class="embed-responsive-item" src="/storage/modul/{{ $modul->file }}.{{ $modul->format_post }}"></embed>
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

@foreach($moduls as $modul)
<script type="text/javascript">     
    $(function () {
        $(document).on("click", "#kosong", function(e) {
            e.preventDefault();
            $.ajax({
                data: $('#he').serialize(),
                url: "/modul/save/{{$modul->id_post}}",
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
                url: "/modul/remove/{{$modul->id_post}}",
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
    $('#modules').addClass('active');
</script>
@endsection
