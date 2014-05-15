<!--head-->
@include('../head')
<!--head end-->
<div class="container">
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
	
	
</div>
</body>
</html>