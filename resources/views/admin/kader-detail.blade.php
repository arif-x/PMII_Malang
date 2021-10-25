@extends('layouts.admin-slider')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12 mt-3">
        <div class="row">
            <div class="col-md-6 mt-2 mb-3">
                <h2>Detail</h2>
                <p class="text-capitalize" id="name_detail"></p>
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

                <form>
                    @csrf        

                    <h3>I. Data Diri:</h3>
                    <div class="alert alert-primary" role="alert">
                        <div class="ml-3 centere">
                            <i class="fa fa-info-circle" style="font-size: 3em"></i> &emsp; Isian Wajib <nobr class="red-color">*</nobr>.
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="nama_lengkap" class="col-sm-12 control-label">Nama Lengkap</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="" maxlength="50" readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="jenis_kelamin" class="col-sm-12 control-label">Jenis Kelamin</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="jenis_kelamin" name="jenis_kelamin" value="" maxlength="50" readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="tanggal_lahir" class="col-sm-12 control-label">Tanggal Lahir</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="" maxlength="50" readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="alamat_lengkap" class="col-sm-12 control-label">Alamat Lengkap</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="alamat_lengkap" name="alamat_lengkap" value="" maxlength="50" readonly>
                                </div>
                            </div>
                        </div>
                    </div>                        

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nama_prov" class="col-sm-12 control-label">Provinsi</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="nama_prov" name="nama_prov" value="" maxlength="50" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nama_kab" class="col-sm-12 control-label">Kabupaten/Kota</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="nama_kab" name="nama_kab" value="" maxlength="50" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nama_kec" class="col-sm-12 control-label">Kecamatan</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="nama_kec" name="nama_kec" value="" maxlength="50" readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_pendidikan" class="col-sm-12 control-label">Pendidikan Terahir</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="nama_pendidikan" name="nama_pendidikan" value="" maxlength="50" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status_pernikahan" class="col-sm-12 control-label">Status Pernikahan</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="status_pernikahan" name="status_pernikahan" value="" maxlength="50" readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="pekerjan" class="col-sm-12 control-label">Pekerjaan</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="pekerjan" name="pekerjan" value="" maxlength="50" readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="no_hp" class="col-sm-12 control-label">Nomor HP</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="no_hp" name="no_hp" value="" maxlength="50" readonly>
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
                                <label for="nama_komisariat" class="col-sm-12 control-label">Komisariat</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="nama_komisariat" name="nama_komisariat" value="" maxlength="50" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_rayon" class="col-sm-12 control-label">Rayon</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="nama_rayon" name="nama_rayon" value="" maxlength="50" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tahun_bergabung" class="col-sm-12 control-label">Tahun Bergabung</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="tahun_bergabung" name="tahun_bergabung" value="" maxlength="50" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="angkatan_ke" class="col-sm-12 control-label">Angkatan Ke</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="angkatan_ke" name="angkatan_ke" value="" maxlength="50" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="kaderisasi_terakhir" class="col-sm-12 control-label">Kaderisasi Terahir</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="kaderisasi_terakhir" name="kaderisasi_terakhir" value="" maxlength="50" readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>
                </form>                    
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        var data_id = "{{ $id }}";
        console.log = data_id;
        $.get("{{ route('all.index') }}" +'/' + data_id +'/edit', function (data) {
            $('#name_detail').html(data[0].nama_lengkap);
            $('#nama_lengkap').val(data[0].nama_lengkap);
            $('#tanggal_lahir').val(data[0].tanggal_lahir);
            $('#jenis_kelamin').val(data[0].jenis_kelamin);
            $('#nama_prov').val(data[0].nama_prov);
            $('#nama_kab').val(data[0].nama_kab);
            $('#nama_kec').val(data[0].nama_kec);
            $('#alamat_lengkap').val(data[0].alamat_lengkap);
            $('#status_pernikahan').val(data[0].status_pernikahan);
            $('#nama_pendidikan').val(data[0].nama_pendidikan);
            $('#pekerjan').val(data[0].pekerjan);
            $('#no_hp').val(data[0].no_hp);

            $('#nama_komisariat').val(data[0].nama_komisariat);
            $('#nama_rayon').val(data[0].nama_rayon);
            $('#tahun_bergabung').val(data[0].tahun_bergabung);
            $('#angkatan_ke').val(data[0].angkatan_ke);
            $('#kaderisasi_terakhir').val(data[0].kaderisasi_terakhir);
        })
    });
</script>
<script type="text/javascript">
    $('#profil').addClass('active');
</script>
@endsection
