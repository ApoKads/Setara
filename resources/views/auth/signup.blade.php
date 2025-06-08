<!-- resources/views/auth/signup.blade.php -->
<form action="{{ route('signup') }}" method="POST">
    @csrf

    <!-- Input Name -->
    <div>
        <label for="name">Name</label>
        <input type="text" name="name" value="{{ old('name') }}" required>
        @error('name')
            <p>{{ $message }}</p> <!-- Menampilkan error untuk name -->
        @enderror
    </div>

    <!-- Input Email -->
    <div>
        <label for="email">Email</label>
        <input type="email" name="email" value="{{ old('email') }}" required>
        @error('email')
            <p>{{ $message }}</p> <!-- Menampilkan error untuk email -->
        @enderror
    </div>

    <!-- Input Password -->
    <div>
        <label for="password">Password</label>
        <input type="password" name="password" required>
        @error('password')
            <p>{{ $message }}</p> <!-- Menampilkan error untuk password -->
        @enderror
    </div>

    <!-- Input Password Confirmation -->
    <div>
        <label for="password_confirmation">Confirm Password</label>
        <input type="password" name="password_confirmation" required>
    </div>

    <!-- Input Role -->
    <div>
        <label for="role">Role</label>
        <select name="role" required>
            <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
            <option value="company" {{ old('role') == 'company' ? 'selected' : '' }}>Company</option>
            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
        </select>
        @error('role')
            <p>{{ $message }}</p> <!-- Menampilkan error untuk role -->
        @enderror
    </div>

    <button type="submit">Sign Up</button>
</form>