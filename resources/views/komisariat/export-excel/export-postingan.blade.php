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
                <th>Post Oleh</th>
                <th>Jenis Post</th>
                <th>Judul Post</th>
                <th>Tanggal Post</th>
                <th>Keterangan Post</th>
                <th>File Post</th>
                <th>Nama File</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1 @endphp
            @foreach($datas as $data)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $data->nama_lengkap }}</td>
                <td>{{ $data->kategori }}</td>
                <td>{{ $data->judul_post }}</td>
                <td>{{ $data->tanggal_post }}</td>
                <td>{{ $data->keterangan_post }}</td>
                <td>{{ $data->post }}</td>
                <td>{{ $data->file }}.{{ $data->format_post }}</td>            
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>