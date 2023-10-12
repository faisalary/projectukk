<!DOCTYPE html>
<html>
<head>
    <title>Login Admin</title>
</head>
<body>
    <h1>Login Admin</h1>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class=row>
        <label for="name">Name:</label>
        <input type="name" name="name" required>
        <label for="email">Email:</label>
        <input type="email" name="email" required>
        <label for="password">Password:</label>
        <input type="password" name="password" required>
        <button type="submit">Login</button>
        </div>
    </form>
    <p>Belum punya akun admin? <a href="{{ route('admin.register') }}">Register</a></p>
</body>
</html>
