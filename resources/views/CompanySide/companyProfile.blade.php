<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')
</head>

<body>
    <h1>This is Company Profile2</h1>
    <h2>{{ $company['name'] }}</h2>
    <h2>{{ $company['description'] }}</h2>
</body>

</html>