<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>mobile_no</th>
            </tr>
        </thead>
        @foreach ($fetchdata as $fetch)
            <tr>
                <td>{{ $fetch['name'] }}</td>
                <td>{{ $fetch['email'] }}</td>
                <td>{{ $fetch['mobile_no'] }}</td>
            </tr>
        @endforeach
    </table>
</body>

</html>
