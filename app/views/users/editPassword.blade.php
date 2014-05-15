<!--head-->
@include('../head')
<!--head end-->
<div class="container">
			<div id="menu">
			    <ul>
					@include('../navigation_bar')
				</ul>
		</div>
@if (Session::has('message'))
	<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
@if(isset($user_id))

	{{ Form::open(array('action' => array('updatePW', $user_id))) }}

	<div class="form-group">
		{{ Form::label('old_password', trans('messages.old password')) }}
		{{ Form::password('old_password') }}
		{{ $errors->first('old_password', '<span class="error">:message</span>') }}
	</div>
	
	<div class="form-group">
		{{ Form::label('password', trans('messages.new password')) }}
		{{ Form::password('password') }}
		{{ $errors->first('password', '<span class="error">:message</span>') }}
	</div>
	
	<div class="form-group">
		{{ Form::label('password_confirmation', trans('messages.confirm password')) }}
		{{ Form::password('password_confirmation') }}
		{{ $errors->first('password_confirmation', '<span class="error">:message</span>') }}
	</div>
	{{ Form::submit(trans('messages.save'), array('class' => 'btn btn-primary')) }}
	
{{Form::close()}}
@else
	<div>Auaaa</div>
@endif	
		
		
</div>
</body>
</html>