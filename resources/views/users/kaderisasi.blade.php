@extends('layouts.new-slider')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12 mt-3">
        <div class="row">
            <div class="col-md-6 mt-2 mb-3">
                <h2>Kaderisasi</h2>
                <p>Update Data Kaderisasi</p>
            </div>
            <div class="col-md-6" style="text-align: right; margin-top: auto; margin-bottom: auto">
                <!-- <button class="btn btn-info mb-3" style="">
                    <i class="fa fa-arrow-left"></i> Kembali
                </button>
                <button class="btn btn-primary mb-3" style="">
                    <i class="fa fa-save"></i> Simpan
                </button> -->
            </div>
        </div>
        @if ($message = Session::get('info'))
        <div class="col-md-12 alert alert-info alert-block margin-tengah">
            <button type="button" class="close" data-dismiss="alert">×</button>    
            <strong>{{ $message }}</strong>
        </div>
        @endif
        <div class="card">

            <div class="card-body">

                <form method="POST" action="/kaderisasi/submit" id="kaderisasiForm">
                    @csrf

                    @if($errors->any())
                    {{ implode('', $errors->all('<div>:message</div>')) }}
                    @endif  

                    <h2>II. Data Kaderisasi:</h2>

                    <div class="alert alert-primary" role="alert">
                        <div class="ml-3 centere">
                            <i class="fa fa-info-circle" style="font-size: 3em"></i> &emsp; Isian Kaderisasi.
                        </div>
                    </div>

                    <h3>MAPABA:</h3>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="komisariatPenyelenggara" class="col-form-label text-md-right">Komisariat Penyelenggara <nobr class="red-color">*</nobr></label>

                                <div class="">
                                    <div class="form-group">                    

                                        <div class="">
                                            <select name="komisariatPenyelenggara" class="form-control">
                                                <option value="">Pilih komisariat Penyelenggara</option>
                                                @foreach ($komisariat as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="rayonPenyelenggara" class="col-form-label text-md-right">Rayon Penyelenggara <nobr class="red-color">*</nobr></label>

                                <div class="">
                                    <div class="form-group">                    

                                        <div class="">
                                            <select name="rayonPenyelenggara" class="form-control">
                                                <option value="">Pilih Rayon</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tahun" class="col-form-label text-md-right">Tahun Bergabung <nobr class="red-color">*</nobr></label>

                                <div class="">
                                    <input id="tahun" type="number" class="form-control @error('tahun') is-invalid @enderror" name="tahun" placeholder="Tahun Bergabung" required autocomplete="new-tahun">

                                    @error('tahun')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="angkatan" class="col-form-label text-md-right">Angkatan Ke <nobr class="red-color">*</nobr></label>

                                <div class="">
                                    <input id="angkatan" type="number" class="form-control @error('angkatan') is-invalid @enderror" name="angkatan" placeholder="Angkatan Ke" required autocomplete="new-angkatan">

                                    @error('angkatan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="kaderisasiTerakhir" class="col-form-label text-md-right">Kaderisasi Terakhir <nobr class="red-color">*</nobr></label>

                                <div class="">
                                    <select name="kaderisasiTerakhir" class="form-control">
                                        <option value="">Pilih Kaderisasi terakhir</option>
                                        @foreach ($kaderisasi_terakhir as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>

                                    @error('kaderisasiTerakhir')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>
                    
                    <div class="form-group row mb-0 mt-4">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary" style="width: 100%;">
                                <i class="fa fa-save"></i> Simpan
                            </button>
                        </div>
                    </div>
                </form>                    
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {

        $('select[name="provinsi"]').on('change', function() {
            var provId = $(this).val();
            if(provId) {
                $.ajax({
                    url: '/get-regency/'+provId,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('select[name="kabupaten"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="kabupaten"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                    }
                });
            } else {
                $('select[name="kabupaten"]').empty();
            }
        });
        $('select[name="kabupaten"]').on('change', function() {
            var kabId = $(this).val();
            if(kabId) {
                $.ajax({
                    url: '/get-district/'+kabId,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('select[name="kecamatan"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="kecamatan"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                    }
                });
            } else {
                $('select[name="kecamatan"]').empty();
            }
        });
        $('select[name="kecamatan"]').on('change', function() {
            var kecId = $(this).val();                 
            if(kecId) {
                $.ajax({
                    url: '/get-village/'+ kecId,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('select[name="kelurahan"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="kelurahan"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                    }
                });
            } else {
                $('select[name="kelurahan"]').empty();
            }
        });
        
        $('select[name="komisariatPenyelenggara"]').on('change', function() {
            var komId = $(this).val();
            if(komId) {
                $.ajax({
                    url: '/get-rayon/'+komId,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('select[name="rayonPenyelenggara"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="rayonPenyelenggara"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                    }
                });
            } else {
                $('select[name="rayonPenyelenggara"]').empty();
            }
        });
    });
</script>

<script type="text/javascript">
    $('#tempatLahir').keyup(function(){

    });
</script>
<script type="text/javascript">
    $('#dashboards').addClass('active');
</script>
@endsection
