@extends('layouts.slider')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12 mt-3">
        <div class="row">
            <div class="col-md-6 mt-2 mb-3">
                <h2>Profil</h2>
                @foreach($profile as $data)
                <p class="text-capitalize">Update Data Profile {{ $data->nama_lengkap }}</p>
                @endforeach
            </div>
            <div class="col-md-6" style="text-align: right; margin-top: auto; margin-bottom: auto">
                <!-- <button class="btn btn-info mb-3" style="">
                    <i class="fa fa-arrow-left"></i> kembali
                </button>
                <button class="btn btn-primary mb-3" style="">
                    <i class="fa fa-save"></i> Simpan
                </button> -->
            </div>
        </div>
        <div class="card">

            <div class="card-body">

                @if($errors->any())
                <div class="mt-2 mb-5 bg-warning" style="padding: 20px">
                    <h1>Error</h1>
                    <li class="text-capitalize" style="font-size: 20px;">{{ implode('', $errors->all(':message')) }}</li>
                </div>
                @endif

                <form method="POST" action="/profile/submit" id="profileForm"  enctype="multipart/form-data">
                    @csrf        

                    <h3>I. Data Diri:</h3>
                    <div class="alert alert-primary" role="alert">
                        <div class="ml-3 centere">
                            <i class="fa fa-info-circle" style="font-size: 3em"></i> &emsp; Isian Wajib <nobr class="red-color">*</nobr>.
                        </div>
                    </div>

                    @foreach($profile as $data)

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="nama" class="col-form-label text-md-right">Nama <nobr class="red-color">*</nobr></label>

                                <div class="">
                                    <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" required autocomplete="new-nama"  placeholder="Nama" value="{{ $data->nama_lengkap }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="jenisKelamin" class="col-form-label text-md-right">Jenis Kelamin <nobr class="red-color">*</nobr></label>

                                <div class="">
                                    <select class="custom-select" name="jenisKelamin" required>
                                        @if(is_null($data->kecamatan))
                                        <option value="">Pilih Jenis Kalamin</option>
                                        <option value="Laki-Laki">Laki-Laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                        @else 
                                        <option value="{{ $data->jenis_kelamin }}">{{ $data->jenis_kelamin }}</option>
                                        <option value="Laki-Laki">Laki-Laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                        @endif                                            
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label for="tanggalLahir" class="col-form-label text-md-right">Tanggal Lahir <nobr class="red-color">*</nobr></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="validationTooltipUsernamePrepend" style="background: #3b5998"><i class="fa fa-calendar" style="color: #fff"></i></span>
                                </div>
                                @php
                                $var = $data->tanggal_lahir;
                                $date = str_replace('/', '-', $var);
                                @endphp
                                <input type="date" name="tanggalLahir" class="form-control" id="validationTooltipUsername" placeholder="Tanggal Lahir" value="{{ date('Y-m-d', strtotime($date)) }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="alamat" class="col-form-label text-md-right">Alamat <nobr class="red-color">*</nobr></label>

                                <div class="">
                                    <input id="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" placeholder="Alamat" required autocomplete="new-alamat" value="{{ $data->alamat_lengkap }}">
                                    <i><small>Sesuai KTP</small></i>

                                    @error('alamat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>                        

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="provinsi" class="col-form-label text-md-right">Provinsi <nobr class="red-color">*</nobr></label>

                                <div class="">
                                    <select name="provinsi" class="form-control text-capitalize">
                                        @if(is_null($data->provinsi))
                                        <option value="">Pilih Provinsi</option>
                                        @else
                                        <option value="{{ $data->prov_id }}">{{ $data->nama_prov }}</option>
                                        @foreach ($provinsi as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                        @endif

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="kabupaten" class="col-form-label text-md-right">Kabupaten/Kota <nobr class="red-color">*</nobr></label>

                                <div class="">
                                    <select name="kabupaten" class="form-control">
                                        @if(is_null($data->kota_kabupaten))
                                        <option value="">Pilih Kabupaten/Kota</option>
                                        @else
                                        <option value="{{ $data->kab_id }}">{{ $data->nama_kab }}</option>
                                        @endif
                                    </select>
                                    <i><small class="form-text text-muted">Pilih provinsi terelebih dahulu</small></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="kecamatan" class="col-form-label text-md-right">Kecamatan <nobr class="red-color">*</nobr></label>

                                <div class="">
                                    <div class="">
                                        <select name="kecamatan" class="form-control" style="text-transform: uppercase;">
                                            @if(is_null($data->kecamatan))
                                            <option value="">Pilih Kecamatan</option>
                                            @else
                                            <option value="{{ $data->kec_id }}">{{ $data->nama_kec }}</option>
                                            @endif
                                        </select>
                                        <i><small class="form-text text-muted">Pilih kabupaten terelebih dahulu</small></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pendidikan" class="col-form-label text-md-right">Pendidikan Terakhir <nobr class="red-color">*</nobr></label>

                                <div class="">
                                    <select name="pendidikan" class="form-control">
                                        @if(is_null($data->pendidikan_terakhir))
                                        <option value="">Pilih Pendidikan_terakhir</option>
                                        @else 
                                        <option value="{{ $data->pendidikan_terakhir }}">{{ $data->nama_pendidikan }}</option>
                                        @endif
                                        @foreach ($pendidikan as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>

                                    @error('pendidikan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="statusKawin" class="col-form-label text-md-right">Status Pernikahan <nobr class="red-color">*</nobr></label>

                                <div class="">
                                    <select class="custom-select" name="statusKawin" required>
                                        @if(is_null($data->status_pernikahan))
                                        <option value="">Pilih Status Pernikahan</option>
                                        @else 
                                        <option value="{{ $data->status_pernikahan }}">{{ $data->status_pernikahan }}</option>
                                        @endif                                            
                                        <option value="Menikah">Menikah</option>
                                        <option value="Belum Menikah">Belum Menikah</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="pekerjaan" class="col-form-label text-md-right">Pekerjaan <nobr class="red-color">*</nobr></label>

                                <div class="">
                                    <select name="pekerjaan" class="form-control">
                                        @if(is_null($data->pekerjaan))
                                        <option value="">Pilih Pekerjaan</option>
                                        @else 
                                        <option value="{{ $data->id_kerja }}">{{ $data->nama_kerja }}</option>
                                        @endif                                            
                                        @foreach ($pekerjaan as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="noHp" class="col-form-label text-md-right">No. HP <nobr class="red-color">*</nobr></label>

                                <div class="">
                                    <input id="noHp" type="number" class="form-control @error('noHp') is-invalid @enderror" name="noHp" placeholder="No. HP" required autocomplete="new-noHp" value="{{ $data->no_hp }}">

                                    @error('noHp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pasFoto" class="col-form-label text-md-right">Pas Foto <nobr class="red-color"></nobr></label>

                                <div class="">
                                    <input id="pasFoto" type="file" class="form-control @error('pasFoto') is-invalid @enderror" placeholder="Pas Foto" name="pasFoto"  autocomplete="new-pasFoto" value="{{ $data->foto_terbaru }}">

                                    <i><small class="form-text text-muted">Opsional</small></i>

                                    @error('pasFoto')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    @endforeach

                    <hr>
                    <br>

                    <h2>II. Data Kaderisasi:</h2>

                    <div class="alert alert-primary" role="alert">
                        <div class="ml-3 centere">
                            <i class="fa fa-info-circle" style="font-size: 3em"></i> &emsp; Isian Kaderisasi.
                        </div>
                    </div>

                    @foreach($kaderisasi as $kader)

                    <h3>MAPABA:</h3>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="komisariatPenyelenggara" class="col-form-label text-md-right">Komisariat <nobr class="red-color">*</nobr></label>

                                <div class="">
                                    <div class="form-group">                    

                                        <div class="">
                                            <select name="komisariatPenyelenggara" class="form-control">
                                                @if(is_null($kader->komisariat))
                                                <option value="">Pilih komisariat Penyelenggara</option>
                                                @else 
                                                <option value="{{ $kader->komisariat }}">{{ $kader->nama_komisariat }}</option>
                                                @endif
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
                                <label for="rayonPenyelenggara" class="col-form-label text-md-right">Rayon <nobr class="red-color">*</nobr></label>

                                <div class="">
                                    <div class="form-group">                    

                                        <div class="">
                                            <select name="rayonPenyelenggara" class="form-control">
                                                @if(is_null($kader->rayon))
                                                <option value="">Pilih Rayon</option>
                                                @else 
                                                <option value="{{ $kader->id_rayon }}">{{ $kader->nama_rayon }}</option>
                                                @endif
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
                                    <input id="tahun" type="number" class="form-control @error('tahun') is-invalid @enderror" name="tahun" placeholder="Tahun Bergabung" required autocomplete="new-tahun" value="{{ $kader->tahun_bergabung }}">

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
                                    <input id="angkatan" type="number" class="form-control @error('angkatan') is-invalid @enderror" name="angkatan" placeholder="Angkatan Ke" required autocomplete="new-angkatan" value="{{ $kader->angkatan_ke }}">

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
                                        @if(is_null($kader->kaderisasi_terakhir))
                                        <option value="">Pilih Kaderisasi Terakhir</option>
                                        @else 
                                        <option value="{{ $kader->kaderisasi_terakhir }}">{{ $kader->kad_terakhir }}</option>
                                        @endif
                                        @foreach ($kaderisasiterakhir as $key => $value)
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

                    @endforeach

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
            var kab = $(this).val();
            if(kab) {
                $.ajax({
                    url: '/get-kabupaten/'+kab,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('select[name="kabupaten"]').empty();
                        $('select[name="kecamatan"]').empty();
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
            var kec = $(this).val();
            if(kec) {
                $.ajax({
                    url: '/get-kecamatan/'+kec,
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

        $('select[name="komisariat"]').on('change', function() {
            var komId = $(this).val();
            if(komId) {
                $.ajax({
                    url: '/get-rayon/'+komId,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('select[name="rayon"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="rayon"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                    }
                });
            } else {
                $('select[name="rayon"]').empty();
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
    $('#profil').addClass('active');
</script>
@endsection
