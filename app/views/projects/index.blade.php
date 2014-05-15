<!--head-->
@include('../head')
<!--head end-->
<div class="container">
			<div id="menu">
			    <ul>
					@include('../navigation_bar')
				</ul>
		</div>

<h1><?php echo trans('messages.All the Projects');?></h1>

<!-- will be used to show any messages -->

@if (Session::has('message'))
	<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<td>ID</td>
			<td><?php echo trans('messages.project name');?></td>
			<td><?php echo trans('messages.customer');?></td>
			<td><?php echo trans('messages.link');?></td>
			<td><?php echo trans('messages.description');?></td>
			<td><?php echo trans('messages.Actions');?></td>
		</tr>
	</thead>
	<tbody>
	@foreach($projects as $key => $value)
		<tr>
			<td>{{ $value->id }}</td>
			<td>{{ $value->project_name }}</td>
			<td>{{$value->company_name}}</td>
			<td>{{$value->link}}</td>
			<td>{{$value->description}}</td>
			
			<td>

				{{ Form::open(array('url' => 'projects/' . $value->id, 'class' => 'pull-right')) }}
					{{ Form::hidden('_method', 'DELETE') }}
					{{ Form::submit( trans('messages.Delete this Project'), array('class' => 'btn btn-warning')) }}
				{{ Form::close() }}
				<!-- show the nerd (uses the show method found at GET /nerds/{id} -->
				<a class="btn btn-small btn-success" href="{{ URL::to('projects/' . $value->id) }}"><?php echo trans('messages.Show this Project');?></a>

				<!-- edit this nerd (uses the edit method found at GET /nerds/{id}/edit -->
				<a class="btn btn-small btn-info" href="{{ URL::to('projects/' . $value->id . '/edit') }}"><?php echo trans('messages.Edit this Project');?></a>

			</td>
		</tr>
	@endforeach
	</tbody>
</table>

</div>
</body>
</html>