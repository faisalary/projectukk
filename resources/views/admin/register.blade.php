<!DOCTYPE html>
<html>
<head>
    <title>Login Admin</title>
</head>
<body>
    <form method="POST" action="{{ route('admin.register') }}">
    @csrf
    <label for="name">Nama:</label>
    <input type="text" name="name" required>
    <label for="email">Email:</label>
    <input type="email" name="email" required>
    <label for="password">Password:</label>
    <input type="password" name="password" required>
    <label for="password_confirmation">Konfirmasi Password:</label>
    <input type="password" name="password_confirmation" required>
    <button type="submit">Daftar</button>
    </form>
</body>
</html>