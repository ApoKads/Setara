<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Homepage</title>
    @vite('resources/css/app.css')
</head>
<body>
    <h1 class="">
        Hello, {{ $profile['name'] }}
    </h1>
</body>
</html>