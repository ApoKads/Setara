<form action="{{ route('signup') }}" method="POST">
    @csrf

    <!-- Input Name -->
    <div class="mb-4">
        <label for="name" class="block">Name</label>
        <input type="text" name="name" value="{{ old('name') }}" class="w-full p-2 border border-gray-300 rounded"
            required>
        @error('name')
            <p class="text-red-500 text-sm">{{ $message }}</p> <!-- Menampilkan error untuk name -->
        @enderror
    </div>

    <!-- Input Email -->
    <div class="mb-4">
        <label for="email" class="block">Email</label>
        <input type="email" name="email" value="{{ old('email') }}" class="w-full p-2 border border-gray-300 rounded"
            required>
        @error('email')
            <p class="text-red-500 text-sm">{{ $message }}</p> <!-- Menampilkan error untuk email -->
        @enderror
    </div>

    <!-- Input Password -->
    <div class="mb-4">
        <label for="password" class="block">Password</label>
        <input type="password" name="password" class="w-full p-2 border border-gray-300 rounded" required>
        @error('password')
            <p class="text-red-500 text-sm">{{ $message }}</p> <!-- Menampilkan error untuk password -->
        @enderror
    </div>

    <!-- Input Password Confirmation -->
    <div class="mb-4">
        <label for="password_confirmation" class="block">Confirm Password</label>
        <input type="password" name="password_confirmation" class="w-full p-2 border border-gray-300 rounded" required>
    </div>

    <!-- Input Role -->
    <div class="mb-4">
        <label for="role" class="block">Role</label>
        <select name="role" class="w-full p-2 border border-gray-300 rounded" required>
            <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
            <option value="company" {{ old('role') == 'company' ? 'selected' : '' }}>Company</option>
            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
        </select>
        @error('role')
            <p class="text-red-500 text-sm">{{ $message }}</p> <!-- Menampilkan error untuk role -->
        @enderror
    </div>

    <button type="submit" class="w-full py-2 bg-blue-500 text-white rounded">Sign Up</button>
</form>