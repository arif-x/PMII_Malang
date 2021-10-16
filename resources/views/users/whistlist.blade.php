@extends('layouts.slider')

@section('content')
<div class="mt-5">
    <div class="col-md-12">        
        <div class="row">
            @foreach($wlist as $saved)
            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 text-left text-capitalize">
                            <h4>{{ $saved->judul_post }}</h4>
                                Kategori: {{ $saved->jenis_postingan }}
                            </div>
                            <div class="col-md-12 text-right">
                                <hr>
                                <i>Disimpan pada {{ $saved->created_at }}</i>
                            </div>
                        </div>
                    </div>
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
