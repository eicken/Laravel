<!-- app/views/login.blade.php -->

<!doctype html>
<html>
<head>
<title>Login</title>
</head>
<body>

{{ Form::open(array('url' => 'login')) }}
<h1>Login</h1>
<p>
{{ Form::label('email') }}
{{ Form::text('email') }}
</p>
<p>
{{ Form::label('password') }}
{{ Form::password('password') }}
</p>
<p>{{ Form::submit('login') }}</p>
{{ Form::close() }}

</body>
</html>