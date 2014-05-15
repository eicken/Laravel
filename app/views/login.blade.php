<!-- app/views/login.blade.php -->

<!doctype html>
<html>
<head>
<title>Login</title>
</head>
<body>

{{ Form::open(array('url' => 'login')) }}
<h1>Login</h1>

<div id="lang">
	<span><a href="{{ URL::to('login/1') }}">German</a></span>
	<span><a href="{{ URL::to('login/2') }}">English</a></span>
</div> 

@if (Session::get('message'))
		<div class="alert alert-danger">{{ Session::get('message') }}</div>
@endif

@if ( $errors->count() > 0 )
      <ul>
        @foreach( $errors->all() as $message )
          <li>{{ $message }}</li>
        @endforeach
      </ul>
@endif
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