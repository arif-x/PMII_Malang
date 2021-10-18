@extends('layouts.new-slider')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12 mt-3">        
        <div class="row">
            <div class="col-md-6 mt-2 mb-3">
                <h2>Profil</h2>
                <p>Isian Data Profil</p>
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

                <form method="POST" action="/new-profile/submit" id="profileForm"  enctype="multipart/form-data">
                    @csrf

                    @if($errors->any())
                    {{ implode('', $errors->all('<div>:message</div>')) }}
                    @endif  

                    <h3>I. Data Diri:</h3>
                    <div class="alert alert-primary" role="alert">
                        <div class="ml-3">
                            <i class="fa fa-info-circle" style="font-size: 3em"></i> &emsp; Isian Wajib <nobr class="red-color">*</nobr>.
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="nama" class="col-form-label text-md-right">Nama <nobr class="red-color">*</nobr></label>

                                <div class="">
                                    <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" required autocomplete="new-nama"  placeholder="Nama">
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
                                        <option value="">Pilih Jenis Kalamin</option>
                                        <option value="Laki-Laki">Laki-Laki</option>
                                        <option value="Perempuan">Perempuan</option>
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
                                <input type="date" name="tanggalLahir" class="form-control" id="validationTooltipUsername" placeholder="Tanggal Lahir" required class="@error('tampat_lahir') is-invalid @enderror">

                                @error('tanggal_lahir')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="alamat" class="col-form-label text-md-right">Alamat <nobr class="red-color">*</nobr></label>

                                <div class="">
                                    <input id="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" placeholder="Alamat" required autocomplete="new-alamat">
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
                                    <select name="provinsi" class="form-control">
                                        <option value="">Pilih Provinsi</option>
                                        @foreach ($provinsi as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="kabupaten" class="col-form-label text-md-right">Kabupaten/Kota <nobr class="red-color">*</nobr></label>

                                <div class="">
                                    <select name="kabupaten" class="form-control">
                                        <option value="">Pilih Kabupaten</option>
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
                                        <select name="kecamatan" class="form-control">
                                            <option value="">Pilih Kabupaten</option>
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
                                        <option value="">Pilih Pendidikan</option>
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
                                <label for="statusKawin" class="col-form-label text-md-right">Status pernikahan <nobr class="red-color">*</nobr></label>

                                <div class="">
                                    <select class="custom-select @error('statusKawin') is-invalid @enderror" name="statusKawin" required>
                                        <option value="">Pilih Status Pernikahan</option>
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
                                    <select name="pekerjaan" class="form-control @error('pekerjaan') is-invalid @enderror">
                                        <option value="">Pilih Pekerjaan</option> 
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
                                    <input id="noHp" type="number" class="form-control @error('noHp') is-invalid @enderror" name="noHp" placeholder="No. HP" required autocomplete="new-noHp">

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
                                <label for="pasFoto" class="col-form-label text-md-right">Pas Foto <nobr class="red-color">*</nobr></label>

                                <div class="">
                                    <input id="pasFoto" type="file" class="form-control @error('pasFoto') is-invalid @enderror" placeholder="Pas Foto" name="pasFoto" required autocomplete="new-pasFoto">

                                    @error('pasFoto')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>                        
                    </div>

                    <hr>
                    <!-- <br>

                    <h2>III. Data Pendukung:</h2>

                    <div class="alert alert-primary" role="alert">
                        <div class="ml-3 centere">
                            <i class="fa fa-info-circle" style="font-size: 3em"></i> &emsp; Isian Opsional, jika ada sebaiknya dilengkapi. Kosongkan jika tidak ada.
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label for="noWa" class="col-form-label text-md-right">No. WA</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="validationTooltipUsernamePrepend" style="background: #1BC5BD"><i class="fa fa-whatsapp" style="color: #fff"></i></span>
                                </div>
                                <input type="number" name="noWa" placeholder="08123456789" class="form-control" id="validationTooltipUsername">
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <label for="email" class="col-form-label text-md-right">Email</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="validationTooltipUsernamePrepend" style="background: #F64E60"><i class="fa fa-envelope" style="color: #fff"></i></span>
                                </div>
                                <input type="email" name="email" placeholder="username@gmail.com" class="form-control" id="validationTooltipUsername">                                    
                            </div>
                            <i><small class="form-text text-muted">Contoh: username@gmail.com</small></i>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <label for="facebook" class="col-form-label text-md-right">Facebook</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="validationTooltipUsernamePrepend" style="background: #3b5998"><i class="fa fa-facebook" style="color: #fff"></i></span>
                                </div>
                                <input type="text" name="facebook" placeholder="facebook.com/username" class="form-control" id="validationTooltipUsername">
                            </div>
                            <i><small class="form-text text-muted">Contoh: facebook.com/username</small></i>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <label for="twitter" class="col-form-label text-md-right">Twitter</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="validationTooltipUsernamePrepend" style="background: #1da1f2"><i class="fa fa-twitter" style="color: #fff"></i></span>
                                </div>
                                <input type="text" name="twitter" placeholder="twitter.com/username" class="form-control" id="validationTooltipUsername">
                            </div>
                            <i><small class="form-text text-muted">Contoh: twitter.com/username</small></i>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label for="instagram" class="col-form-label text-md-right">Instagram</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="validationTooltipUsernamePrepend" style="background: #e1306c"><i class="fa fa-instagram" style="color: #fff"></i></span>
                                </div>
                                <input type="text" name="instagram" placeholder="instagram.com/username" class="form-control" id="validationTooltipUsername">
                            </div>
                            <i><small class="form-text text-muted">Contoh: instagram.com/username</small></i>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label for="linkedin" class="col-form-label text-md-right">LinkedIn</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="validationTooltipUsernamePrepend" style="background: #0077b5"><i class="fa fa-linkedin" style="color: #fff"></i></span>
                                </div>
                                <input type="text" name="linkedin" placeholder="linkedin.com/in/username" class="form-control" id="validationTooltipUsername">
                            </div>
                            <i><small class="form-text text-muted">Contoh: linkedin.com/in/username</small></i>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label for="fotoResmi" class="col-form-label text-md-right">Foto Resmi</label>
                            <div class="input-group">
                                <input type="file" name="fotoResmi" class="form-control" id="fotoResmi">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label for="fotoKTP" class="col-form-label text-md-right">Foto KTP</label>
                            <div class="input-group">
                                <input type="file" name="fotoKTP" class="form-control" id="fotoKTP">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label for="fotoKtm" class="col-form-label text-md-right">Foto KTM</label>
                            <div class="input-group">
                                <input type="file" name="fotoKtm" class="form-control" id="fotoKtm">
                            </div>
                        </div>
                    </div> -->


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
    });
</script>

<script type="text/javascript">
    $('#dashboards').addClass('active');
</script>
@endsection
