@extends('layouts.slider')

@section('content')
<div class="mt-5">
    <div class="col-md-12">        
        <div class="row">
            @foreach($hist as $history)
            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 text-left">
                                {{ $history->jenis }}
                            </div>
                            <div class="col-md-12 text-right">
                                <hr>
                                <i>Pada {{ $history->created_at }}</i>
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
    $('#histories').addClass('active');
</script>
@endsection
