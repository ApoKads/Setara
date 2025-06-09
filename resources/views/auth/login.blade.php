<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    @vite('resources/css/app.css')
</head>

<body>
    <!-- Menampilkan error jika ada -->
    @if($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <!-- Form login -->
    <form method="POST" action="{{ route('login') }}">
        @csrf <!-- Token untuk CSRF Protection -->

        <!-- Input Email -->
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus>
            
        </div>

        <!-- Input Password -->
        <div>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="bg-blue-500">Login</button>
    </form>
</body>

</html>