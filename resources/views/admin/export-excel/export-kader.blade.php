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
        </tr>
    </thead>
    <tbody>
        @php $no = 1 @endphp
        @foreach($datas as $data)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $data->nama_lengakp }}</td>
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
        </tr>
        @endforeach
    </tbody>
</table>