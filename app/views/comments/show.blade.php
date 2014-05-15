<!--head-->
@include('../head')
<!--head end-->
<div class="container" >
			<div id="menu">
			    <ul>
					@include('../navigation_bar')
				</ul>
		</div>
<h1>{{ trans('messages.Showing')}} {{ $ticket->subject}}</h1>

	<div class="jumbotron text-center">
		<table cellspacing="3">
			<tr><td class="pull-left">id:</td><td>{{ $ticket->id }}</td></tr>
			<tr><td class="pull-left">{{trans('messages.created at')}}:</td><td>{{ date('d.m.y', strtotime($ticket->created_at))}} {{trans('messages.at')}} {{ date('H:i', strtotime($ticket->created_at))}}</td></tr>
			<tr><td class="pull-left">{{trans('messages.last time updated at')}}:</td><td>{{ date('d.m.y', strtotime($ticket->updated_at))}} {{trans('messages.at')}} {{ date('H:i', strtotime($ticket->updated_at))}}</td></tr>
			<tr><td class="pull-left">{{trans('messages.subject')}}:</td><td>{{ $ticket->subject}}</td></tr>
			<tr><td class="pull-left">{{trans('messages.link')}}:</td><td>{{ $ticket->link}}</td></tr>
			<tr><td class="pull-left">{{trans('messages.status')}}:</td><td>{{ trans('messages.'.$ticket->status_name)}}</td></tr>
			<tr><td class="pull-left">{{trans('messages.priority')}}:</td><td>{{ trans('messages.'.$ticket->priority_name)}}</td></tr>
			<tr><td class="pull-left">{{trans('messages.company')}}:</td><td>{{ $ticket->company_name}}</td></tr>
			<tr><td class="pull-left">{{trans('messages.duration')}}:</td><td>{{ $ticket->duration}}</td></tr>
			<tr><td class="pull-left">{{trans('messages.created by')}}:</td><td>{{ $ticket->first_name}}&nbsp;{{ $ticket->first_last}}</td></tr>
			@if(!empty($attachments)) 
			<tr><td colspan="2" class="pull-left">{{trans('messages.attachments')}}:</td></tr>
			<tr>
				<td colspan="2">
					<table class="table table-striped table-bordered" style="margin:20px 0 0 0;">
						@foreach($attachments as $key => $value)
							<tr>
								<td colspan="2"><a href="{{ URL::to('/app/storage/uploads/project_id_') }}{{$ticket->project}}/{{ $value->hashed_file_name}}">{{ $value->file_name }}</a></td>
							</tr>
						@endforeach
					</table>
				</td>
			</tr>
			@endif
			<tr><td>{{trans('messages.description')}}:</td><td>{{ $ticket->description}}</td></tr>
		</table>
	</div>
	
		<a class="btn btn-primary"  data-target="#myModal" href="{{ URL::to('comments/create') }}"><?php echo trans('messages.Add comment');?></a>
	<!-- @if(isset($comment)) 
		{{ Form::model($ticket, array('route' => array('tickets.update', $ticket->id), 'method' => 'PUT', 'files' => true)) }}
		<h1><?php echo trans('messages.Ticket Information');?></h1>
	@else	
		{{ Form::open(array('url' => $action)) }}
		<h1><?php echo trans('messages.Create Ticket');?></h1>
	@endif
	
	<div class="form-group">
		{{ Form::label('comment', trans('messages.your Comment')) }}
		{{ Form::textarea('comment', Input::old('comment'), array('class' => 'form-control')) }}
		{{ $errors->first('comment', '<span class="error">:message</span>') }}
	</div>
	
					{{ Form::hidden('ticket_id', $ticket->id) }}

	{{ Form::submit(trans('messages.save'), array('class' => 'btn btn-primary')) }}

{{ Form::close() }}-->



@if(!empty($comments)) 
	<div class="jumbotron text-center" style="margin:20px 0 0 0">
		<table  style="margin:20px 0 0 0;">
		<tr><td><h4>{{trans('messages.all comments')}}</h4></td></tr>
		@foreach($comments as $key => $value)
			<tr>
				<td colspan="2">
					<div style="margin:0 0 30px 0">
						<span style="float:left;">{{$value->first_name}}&nbsp;{{$value->last_name}}</span>
						<span style="margin:0 0 0 20px;">{{trans('messages.worte in')}}&nbsp;{{ date('d.m.y', strtotime($value->created_at))}} {{trans('messages.at')}} {{ date('H:i', strtotime($value->created_at))}}</span><br/>
						{{ $value->comment }}
						
						@if($value->user_id == $user_id) 
						<div>
						
						
						<!--<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">{{trans('messages.edit comment')}}</button>-->
						<a class="btn btn-primary"  data-target="#myModal" href="{{ URL::to('comments/'. $value->id . '/edit') }}"><?php echo trans('messages.Edit');?></a>
						{{ Form::open(array('url' => 'comments/' . $value->id, 'class' => 'pull-right')) }}
							{{ Form::hidden('_method', 'DELETE') }}
							{{ Form::hidden('ticket', 'ticket') }}
							{{ Form::submit( trans('messages.Delete this Comment'), array('class' => 'btn btn-warning')) }}
						{{ Form::close() }}
						</div>
						@endif
					</div>
				</td>
			</tr>
		@endforeach
		</table>
			@endif
	</div>
	
@include('comments.modal')	
</div>
<script type="text/javascript">
$("a[data-target=#myModal]").click(function(ev) {
    ev.preventDefault();
    var target = $(this).attr("href");

    // load the url and show modal on success
    $("#myModal .modal-body").load(target, function() {
    	$('#modal_div').append('<input type="hidden" name="ticket_id" value="{{ $ticket->id }}" />');  
        $("#myModal").modal("show"); 
    });
});

$('#submit').click(function(){
    
    if ($('#comment').val()==="") {
      // invalid
      $('#comment').next('.help-inline').show();
      return false;
    }
    else {
      // submit the form here
      // $('#InfroText').submit();
      
      return true;
    }
});

</script>
</body>
</html>