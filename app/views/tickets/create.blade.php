<!--head-->
@include('../head')

<!--head end-->
<div class="container">
			<div id="menu">
			    <ul>
					@include('../navigation_bar')
				</ul>
		</div>

@if(isset($ticket)) 
	{{ Form::model($ticket, array('route' => array('tickets.update', $ticket->id), 'method' => 'PUT', 'files' => true)) }}
	<h1><?php echo trans('messages.Ticket Information');?></h1>
@else	
	{{ Form::open(array('url' => $action)) }}
	<h1><?php echo trans('messages.Create Ticket');?></h1>
@endif

<!-- if there are creation errors, they will show here -->
@if (Session::has('message'))
	<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
	<div class="form-group">
		{{ Form::label('subject', trans('messages.subject')) }}
		{{ Form::text('subject', Input::old('subject'), array('class' => 'form-control')) }}
		{{ $errors->first('subject', '<span class="error">:message</span>') }}
	</div>
	
	<div class="form-group">
		{{ Form::label('status', trans('messages.status')) }}
		{{ Form::select('status',$status , Input::old('status')) }}
		{{ $errors->first('status', '<span class="error">:message</span>') }}
	</div>
	
	<div class="form-group">
		{{ Form::label('priority', trans('messages.priority')) }}
		{{ Form::select('priority', $priorities , Input::old('status')) }}
		{{ $errors->first('priority', '<span class="error">:message</span>') }}
	</div>

	<div class="form-group">
		{{ Form::label('project', trans('messages.project')) }}
		{{ Form::select('project', $projects , Input::old('project')) }}
		{{ $errors->first('project', '<span class="error">:message</span>') }}
	</div>
	
	
	<div class="form-group">
		{{ Form::label('description', trans('messages.description')) }}
		{{ Form::textarea('description', Input::old('description'), array('class' => 'form-control')) }}
		{{ $errors->first('description', '<span class="error">:message</span>') }}
	</div>
	
	<div class="form-group">
		{{ Form::label('link', trans('messages.link')) }}
		{{ Form::text('link', Input::old('link'), array('class' => 'form-control')) }}
		{{ $errors->first('link', '<span class="error">:message</span>') }}
	</div>
	
	<div class="form-group">
		{{ Form::label('duration', trans('messages.duration')) }}
		{{ Form::text('duration', Input::old('duration'), array('class' => 'form-control')) }}
		{{ $errors->first('duration', '<span class="error">:message</span>') }}
	</div>
	
	<div class="form-group">
		{{ Form::label('attachment', trans('messages.attachment')) }}
		{{ Form::file('attachment') }}
		{{ $errors->first('attachment', '<span class="error">:message</span>') }}
	</div>
	
	<script type="text/javascript">
	var data = [
							<?php 
							foreach($users as $key => $value)
							{
								echo '{value:"'.$value->email.'", label:"'.$value->first_name.' '.$value->last_name.'"},';
							}
							
							?>
	
						];

			</script>

	<div class="form-group">
		{{ Form::label('send_to', trans('messages.ticket_send_to')) }}
		{{ Form::text('ticket_send_to', Input::old('ticket_send_to'), array('class' => 'form-control', 'id' =>'autocomplete1', 'placeholder'=>trans('messages.please choose one'))) }}
		{{ $errors->first('ticket_send_to', '<span class="error">:message</span>') }}
	</div>

	{{ Form::submit(trans('messages.save'), array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

@if(!empty($attachments)) 
	<div class="form-group">
	<table class="table table-striped table-bordered" style="margin:20px 0 0 0;">
	<thead>
		<tr>
			<td><?php echo trans('messages.file name');?></td>
			<td><?php echo trans('messages.action');?></td>
		</tr>
	</thead>
	<tbody>
@foreach($attachments as $key => $value)
	<tr>
					<td><a href="{{ URL::to('/app/storage/uploads/project_id_') }}{{$ticket->project}}/{{ $value->hashed_file_name}}">{{ $value->file_name }}</a></td>
					<td>{{ Form::open(array('url' => 'tickets/' . $value->id, 'class' => 'center')) }}
					{{ Form::hidden('file_id', $value->id) }}
					{{ Form::hidden('project_id', $ticket->project) }}
					{{ Form::hidden('file', $value->hashed_file_name) }}
					{{ Form::hidden('_method', 'DELETE') }}
					{{ Form::submit( trans('messages.Delete this file'), array('class' => 'btn btn-warning')) }}
				{{ Form::close() }}</td>
	</tr>
		@endforeach
			</tbody>
</table>
	</div>
@endif

</div>
</body>
</html>