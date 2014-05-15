<!--head-->
@include('../head')
<!--head end-->
<div class="container">
			<div id="menu">
			    <ul>
					@include('../navigation_bar')
				</ul>
		</div>

<h1><?php echo trans('messages.All the Tickets');?></h1>

<!-- will be used to show any messages -->

@if (Session::has('message'))
	<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<td>ID</td>
			<td><?php echo trans('messages.subject');?></td>
			<td><?php echo trans('messages.status');?></td>
			<td><?php echo trans('messages.priority');?></td>
			<td><?php echo trans('messages.project_name');?></td>
			<td><?php echo trans('messages.company');?></td>
		</tr>
	</thead>
	<tbody>
	@foreach($tickets as $key => $value)
		<tr>
			<td>{{ $value->id }}</td>
			<td>{{ $value->subject }}</td>
			<td>{{trans('messages.'.$value->status_name)}}</td>
			<td>{{trans('messages.'.$value->priority_name)}}</td>
			<td>{{$value->project_name}}</td>
			<td>{{$value->company_name}}</td>

			<!-- we will also add show, edit, and delete buttons -->
			<td>

				<!-- delete the nerd (uses the destroy method DESTROY /nerds/{id} -->
				<!-- we will add this later since its a little more complicated than the other two buttons -->
				{{ Form::open(array('url' => 'tickets/' . $value->id, 'class' => 'pull-right')) }}
					{{ Form::hidden('_method', 'DELETE') }}
					{{ Form::hidden('ticket', 'ticket') }}
					{{ Form::submit( trans('messages.Delete this Ticket'), array('class' => 'btn btn-warning')) }}
				{{ Form::close() }}
				<!-- show the nerd (uses the show method found at GET /nerds/{id} -->
				<a class="btn btn-small btn-success" href="{{ URL::to('comments/' . $value->id) }}"><?php echo trans('messages.Show this Ticket');?></a>

				<!-- edit this nerd (uses the edit method found at GET /nerds/{id}/edit -->
				<a class="btn btn-small btn-info" href="{{ URL::to('tickets/' . $value->id . '/edit') }}"><?php echo trans('messages.Edit this Ticket');?></a>

			</td>
		</tr>
	@endforeach
	</tbody>
</table>

</div>
</body>
</html>