<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="css/app.css"> -->
    <style>
        table {
            margin-top: 20px;
            width: 50%;
            height: auto;
        }
       table tbody{
            /* margin-left: 200px; */
            text-align: center;
        }
    </style>
    <title>Document</title>
</head>
<header><div><h1>HI {{$data->name}}</h1></div></header>
<body>
    <table>
  <thead>
    <tr>
      <th>Name</th>
      <th>Email</th>
      <th>Logout</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>{{$data->name}}</td>
      <td>{{$data->email}}</td>
      <td><a href="/logout-user">Logout</a></td>
    </tr>
  </tbody>
</table>

    
</body>
</html>