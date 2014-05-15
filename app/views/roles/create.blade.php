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

@if(isset($role)) 
	{{ Form::model($role, array('route' => array('roles.update', $role->id), 'method' => 'PUT')) }}
	<h1><?php echo trans('messages.Role Information');?></h1>
@else	
	{{ Form::open(array('url' => $action)) }}
	<h1><?php echo trans('messages.Create Role');?></h1>
@endif

	<div class="form-group">
		{{ Form::label('role_name', trans('messages.role_name')) }}
		{{ Form::text('role_name', Input::old('role_name'), array('class' => 'form-control')) }}
		{{ $errors->first('role_name', '<span class="error">:message</span>') }}
	</div>
	
	<div class="form-group">
		{{ Form::label('permissions', trans('messages.permissions')) }}
		{{Form::checkbox('permission[]', 'write', Input::old('permission'))}}write
		{{Form::checkbox('permission[]', 'read' , Input::old('permission')) }}read
		{{Form::checkbox('permission[]', 'delete', Input::old('permission')) }}delete
		{{Form::checkbox('permission[]', 'update', Input::old('permission')) }}update
		{{ $errors->first('role_name', '<span class="error">:message</span>') }}
	</div>
	

	{{ Form::submit(trans('messages.save'), array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

</div>
</body>
</html>