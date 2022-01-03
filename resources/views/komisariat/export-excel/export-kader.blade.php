<!DOCTYPE html>
<html>
<head>
    <style type="text/css">
        table, th, td {
            border: 1px solid black;
        }

        table {
            border-collapse: collapse;
        }
    </style>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Lengkap</th>
                <th>Tanggal Lahir</th>
                <th>Jenis Kelamin</th>
                <th>Alamat Lengkap</th>
                <th>Provinsi</th>
                <th>Kota/Kabupaten</th>
                <th>Kecamatan</th>
                <th>Status Pernikahan</th>
                <th>Pendidikan Terakhir</th>
                <th>Pekerjaan</th>
                <th>No. HP</th>
                <th>Tahun Bergabung</th>
                <th>Angkatan Ke-</th>
                <th>Kaderisasi Terakhir</th>
                <th>Komisariat</th>
                <th>Rayon</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1 @endphp
            @foreach($datas as $data)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $data->nama_lengkap }}</td>
                <td>{{ $data->tanggal_lahir }}</td>
                <td>{{ $data->jenis_kelamin }}</td>
                <td>{{ $data->alamat_lengkap }}</td>
                <td>{{ $data->nama_prov }}</td>
                <td>{{ $data->nama_kab }}</td>
                <td>{{ $data->nama_kec }}</td>
                <td>{{ $data->status_pernikahan }}</td>
                <td>{{ $data->nama_pendidikan }}</td>
                <td>{{ $data->nama_kerja }}</td>
                <td>{{ $data->no_hp }}</td>  
                <td>{{ $data->tahun_bergabung }}</td>  
                <td>{{ $data->angkatan_ke }}</td>            
                <td>{{ $data->kaderisasi_terakhir }}</td>  
                <td>{{ $data->nama_komisariat }}</td>  
                <td>{{ $data->nama_rayon }}</td>  
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>