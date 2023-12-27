<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brand</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>


<table>
    <thead>
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Slug</th>
    </tr>
    </thead>
    <tbody>
    @foreach($brands as $brand)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$brand->name}}</td>
            <td>{{$brand->slug}}</td>
        </tr>

    @endforeach
    </tbody>
</table>

</body>
</html>
