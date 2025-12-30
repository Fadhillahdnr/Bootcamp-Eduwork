<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body { font-family: sans-serif; background:#f4f6f8 }
        .card { width:350px; margin:100px auto; background:white; padding:20px; border-radius:8px }
        input, button { width:100%; padding:10px; margin-top:10px }
        button { background:#2563eb; color:white; border:none }
    </style>
</head>
<body>

<div class="card">
    <h2>Login</h2>

    @if($errors->any())
        <p style="color:red">{{ $errors->first() }}</p>
    @endif

    <form method="POST" action="/login">
        @csrf
        <input type="email" name="email" placeholder="Email">
        <input type="password" name="password" placeholder="Password">
        <button type="submit">Login</button>
    </form>
</div>

</body>
</html>
