@extends('layouts.slider')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12 mt-3">
        <div class="row">
            <div class="col-md-6 mt-2 mb-3">
                <h2>Profil</h2>
                <p>Update Data Profile {{Auth::user()->name}}</p>
            </div>
            <div class="col-md-6" style="text-align: right; margin-top: auto; margin-bottom: auto">
                <button class="btn btn-info mb-3" style="">
                    <i class="fa fa-arrow-left"></i> kembali
                </button>
                <button class="btn btn-primary mb-3" style="">
                    <i class="fa fa-save"></i> Simpan
                </button>
            </div>
        </div>
        <div class="card">

            <div class="card-body">

                <form method="POST" action="/profile">
                    @csrf                                                

                    <h3>I. Data Diri:</h3>
                    <div class="alert alert-warning" role="alert">
                        <div class="ml-3 centere">
                            <i class="fa fa-info-circle" style="font-size: 3em"></i> &emsp; Isian Wajib <nobr class="red-color">*</nobr>.
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nik" class="col-form-label text-md-right">NIK <nobr class="red-color">*</nobr></label>

                                <div class="">
                                    <input id="nik" type="number" class="form-control @error('nik') is-invalid @enderror" name="nik" required autocomplete="new-nik" placeholder="NIK">
                                    @error('nik')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ktm" class="col-form-label text-md-right">KTM <nobr class="red-color">*</nobr></label>

                                <div class="">
                                    <input id="ktm" type="number" class="form-control @error('ktm') is-invalid @enderror" name="ktm" required autocomplete="new-ktm" placeholder="NIM KTM">

                                    @error('ktm')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="nama" class="col-form-label text-md-right">Nama <nobr class="red-color">*</nobr></label>

                                <div class="">
                                    <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" required autocomplete="new-nama"  placeholder="Nama" readonly value="{{ Auth::user()->name }}">
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
                        <div class="col-md-6">
                            <label for="tempatLahir" class="col-form-label text-md-right">Tempat Lahir <nobr class="red-color">*</nobr></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="validationTooltipUsernamePrepend" style="background: #3b5998"><i class="fa fa-map-marker" style="color: #fff"></i></span>
                                </div>
                                <input type="text" name="tempatLahir" class="form-control" id="validationTooltipUsername" placeholder="Tampat Lahir" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="tanggalLahir" class="col-form-label text-md-right">Tanggal Lahir <nobr class="red-color">*</nobr></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="validationTooltipUsernamePrepend" style="background: #3b5998"><i class="fa fa-calendar" style="color: #fff"></i></span>
                                </div>
                                <input type="date" name="tanggalLahir" class="form-control" id="validationTooltipUsername" placeholder="Tanggal Lahir" required>
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
                        <div class="col-md-6">
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
                        <div class="col-md-6">
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
                    </div>

                    <div class="row">
                        <div class="col-md-6">
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
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kelurahan" class="col-form-label text-md-right">Desa/Kelurahan <nobr class="red-color">*</nobr></label>

                                <div class="">
                                    <div class="">
                                        <select name="kelurahan" class="form-control">
                                            <option value="">Pilih Desa/Kelurahan</option>  
                                        </select>
                                        <i><small class="form-text text-muted">Pilih kecamatan terelebih dahulu</small></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="rt" class="col-form-label text-md-right">RT <nobr class="red-color">*</nobr></label>

                                <div class="">
                                    <input id="rt" type="number" class="form-control @error('rt') is-invalid @enderror" name="rt" placeholder="RT" required autocomplete="new-rt">

                                    @error('rt')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="rw" class="col-form-label text-md-right">RW <nobr class="red-color">*</nobr></label>

                                <div class="">
                                    <input id="rw" type="number" class="form-control @error('rw') is-invalid @enderror" name="rw" placeholder="RW" required autocomplete="new-rw">

                                    @error('rw')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="komisariat" class="col-form-label text-md-right">Komisariat <nobr class="red-color">*</nobr></label>

                                <div class="">
                                    <select name="komisariat" class="form-control">
                                        <option value="">Pilih Komisariat</option>
                                        @foreach ($komisariat as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="rayon" class="col-form-label text-md-right">Rayon <nobr class="red-color">*</nobr></label>

                                <div class="">
                                    <select name="rayon" class="form-control">
                                        <option value="">Pilih Rayon</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="fakultas" class="col-form-label text-md-right">Fakultas <nobr class="red-color">*</nobr></label>

                                <div class="">
                                    <input id="fakultas" type="text" class="form-control @error('fakultas') is-invalid @enderror" placeholder="Fakultas" name="fakultas" required autocomplete="new-fakultas">

                                    @error('fakultas')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pendidikan" class="col-form-label text-md-right">Pendidikan Terakhir <nobr class="red-color">*</nobr></label>

                                <div class="">
                                    <input id="pendidikan" type="text" class="form-control @error('pendidikan') is-invalid @enderror" placeholder="Pendidikan" name="pendidikan" required autocomplete="new-pendidikan">

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
                                <label for="statusKawin" class="col-form-label text-md-right">Status Kawin <nobr class="red-color">*</nobr></label>

                                <div class="">
                                    <select class="custom-select" name="statusKawin" required>
                                        <option value="">Pilih Status Perkawinan</option>
                                        <option value="kawin">Kawin</option>
                                        <option value="belum kawin">Belum Kawin</option>
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
                                <label for="golonganDarah" class="col-form-label text-md-right">Golongan Darah <nobr class="red-color">*</nobr></label>

                                <div class="">
                                    <select class="custom-select" name="golonganDarah" required>
                                        <option value="">Pilih Golongan Darah</option>
                                        <option value="o">O</option>
                                        <option value="a">A</option>
                                        <option value="b">B</option>
                                        <option value="ab">AB</option>
                                        <option value="tidak tahu">Tidak Tahu</option>
                                    </select>
                                </div>
                            </div>
                        </div>
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
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="pasFoto" class="col-form-label text-md-right">Pas Foto <nobr class="red-color">*</nobr></label>

                                <div class="">
                                    <input id="pasFoto" type="text" class="form-control @error('pasFoto') is-invalid @enderror" placeholder="Pas Foto" name="pasFoto" required autocomplete="new-pasFoto">

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
                    <br>

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
                                    <input id="kaderisasiTerakhir" type="text" class="form-control @error('kaderisasiTerakhir') is-invalid @enderror" name="kaderisasiTerakhir" placeholder="Kaderisasi Terakhir" required autocomplete="new-kaderisasiTerakhir">

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
                    <br>

                    <h2>III. Data Pendukung:</h2>

                    <div class="alert alert-success" role="alert">
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
                    </div>


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
    $('#dashboards').addClass('active');
</script>
@endsection
