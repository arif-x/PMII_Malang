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
                <th>Nama Pekerjaan</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1 @endphp
            @foreach($datas as $data)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $data->pekerjan }}</td>           
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>