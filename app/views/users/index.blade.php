<!--head-->
@include('../head')
<!--head end-->
<div class="container">
			<div id="menu">
			    <ul>
					@include('../navigation_bar')
				</ul>
		</div>

<h1><?php echo trans('messages.All the Users');?></h1>

<!-- will be used to show any messages -->

@if (Session::has('message'))
	<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<td>ID</td>
			<td><?php echo trans('messages.lastname');?></td>
			<td><?php echo trans('messages.email-address');?></td>
			<td><?php echo trans('messages.Groupe');?></td>
			<td><?php echo trans('messages.Actions');?></td>
		</tr>
	</thead>
	<tbody>
	@foreach($users as $key => $value)
		<tr>
			<td>{{ $value->id }}</td>
			<td>{{ $value->last_name }}</td>
			<td>{{ $value->email }}</td>
			<td>{{$value->role_name}}</td>

			<!-- we will also add show, edit, and delete buttons -->
			<td>

				<!-- delete the nerd (uses the destroy method DESTROY /nerds/{id} -->
				<!-- we will add this later since its a little more complicated than the other two buttons -->
				{{ Form::open(array('url' => 'users/' . $value->id, 'class' => 'pull-right')) }}
					{{ Form::hidden('_method', 'DELETE') }}
					{{ Form::submit( trans('messages.Delete this User'), array('class' => 'btn btn-warning')) }}
				{{ Form::close() }}
				<!-- show the nerd (uses the show method found at GET /nerds/{id} -->
				<a class="btn btn-small btn-success" href="{{ URL::to('users/' . $value->id) }}"><?php echo trans('messages.Show this User');?></a>

				<!-- edit this nerd (uses the edit method found at GET /nerds/{id}/edit -->
				<a class="btn btn-small btn-info" href="{{ URL::to('users/' . $value->id . '/edit') }}"><?php echo trans('messages.Edit this User');?></a>

			</td>
		</tr>
	@endforeach
	</tbody>
</table>

</div>
</body>
</html>