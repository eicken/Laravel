<!--head-->
@include('../head')
<!--head end-->
<div class="container">
			<div id="menu">
			    <ul>
					@include('../navigation_bar')
				</ul>
		</div>

<!-- if there are creation errors, they will show here -->

@if(isset($user)) 
{{ Form::model($user, array('route' => array('users.update', $user->id))) }}
	<h1><?php echo trans('messages.User Information');?></h1>
@else	
	{{ Form::open(array('route' => 'users.store')) }}
	<h1><?php echo trans('messages.Create User');?></h1>
@endif



	<div class="form-group">
		{{ Form::label('greeting', trans('messages.greeting')) }}
		{{ Form::select('greeting', array(' ' => trans('messages.select greeting'), 'Herr' => trans('messages.Mr'), 'Frau' =>  trans('messages.Mrs.'),), Input::old('nerd_level'), array('class' => 'form-control')) }}
		{{ $errors->first('greeting', '<span class="error">:message</span>') }}
	</div>

	<div class="form-group">
		{{ Form::label('first_name', trans('messages.firstname')) }}
		{{ Form::text('first_name', Input::old('first_name'), array('class' => 'form-control')) }}
		{{ $errors->first('first_name', '<span class="error">:message</span>') }}
	</div>
	
	<div class="form-group">
		{{ Form::label('last_name', trans('messages.lastname')) }}
		{{ Form::text('last_name', Input::old('last_name'), array('class' => 'form-control')) }}
		{{ $errors->first('last_name', '<span class="error">:message</span>') }}
	</div>

	<div class="form-group">
		{{ Form::label('email', trans('messages.email-address')) }}
		{{ Form::email('email', Input::old('email'), array('class' => 'form-control')) }}
		{{ $errors->first('email', '<span class="error">:message</span>') }}
	</div>
	
	
	<div class="form-group">
		{{ Form::label('phone', trans('messages.phone')) }}
		{{ Form::text('phone', Input::old('phone'), array('class' => 'form-control')) }}
		{{ $errors->first('phone', '<span class="error">:message</span>') }}
	</div>
	
@if(!isset($user))	
	<div class="form-group">
		{{ Form::label('password', trans('messages.password')) }}
		{{ Form::password('password') }}
		{{ $errors->first('password', '<span class="error">:message</span>') }}
	</div>
	<div class="form-group">
		{{ Form::label('password_confirmation', trans('messages.password')) }}
		{{ Form::password('password_confirmation') }}
		{{ $errors->first('password_confirmation', '<span class="error">:message</span>') }}
	</div>
@endif

	<div class="form-group">
		{{ Form::label('role', trans('messages.role')) }}
		{{ Form::select('role_id', $roles , Input::old('role_id')) }}
		{{ $errors->first('role_id', '<span class="error">:message</span>') }}
	</div>
	
	<div class="form-group">
		{{ Form::label('customer', trans('messages.customers')) }}
		{{ Form::select('customer_id', $customers , Input::old('customer_id')) }}
		{{ $errors->first('customer_id', '<span class="error">:message</span>') }}
	</div>
	

	{{ Form::submit(trans('messages.save'), array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

@if(isset($user)) 
	<?php echo $user->id;?>
	<a class="btn btn-small btn-success" href="{{ URL::to('users/editPW/' . $user->id )}}"><?php echo trans('messages.change password');?></a>
@endif

</div>
</body>
</html>