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

@if(isset($project)) 
	{{ Form::model($project, array('route' => array('projects.update', $project->id), 'method' => 'PUT')) }}
	<h1><?php echo trans('messages.Project Information');?></h1>
@else	
	{{ Form::open(array('url' => $action)) }}
	<h1><?php echo trans('messages.Create Project');?></h1>
@endif
	<div class="form-group">
		{{ Form::label('project_name', trans('messages.project_name')) }}
		{{ Form::text('project_name', Input::old('project_name'), array('class' => 'form-control')) }}
		{{ $errors->first('project_name', '<span class="error">:message</span>') }}
	</div>
	
	<div class="form-group">
		{{ Form::label('customer', trans('messages.customers')) }}
		{{ Form::select('customer_id', $customers , Input::old('customer_id')) }}
		{{ $errors->first('customer_id', '<span class="error">:message</span>') }}
	</div>

	<div class="form-group">
		{{ Form::label('link', trans('messages.link')) }}
		{{ Form::text('link', Input::old('link'), array('class' => 'form-control')) }}
		{{ $errors->first('link', '<span class="error">:message</span>') }}
	</div>
	
	
	<div class="form-group">
		{{ Form::label('description', trans('messages.description')) }}
		{{ Form::textarea('description', Input::old('description'), array('class' => 'form-control')) }}
		{{ $errors->first('description', '<span class="error">:message</span>') }}
	</div>
	
	<div class="form-group">
		{{ Form::label('project_users', trans('messages.Project Users')) }}
		{{ Form::select('multiselect[]', $user , Input::old('multiselect'), array('class'=>'multiselect', 'id'=>'multiselect_simple', 'multiple'=>'multiple', 'style'=>'width:60%; height:50%;')) }}
		{{ $errors->first('multiselect', '<span class="error">:message</span>') }}
	</div>



	{{ Form::submit(trans('messages.save'), array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

</div>
</body>
</html>