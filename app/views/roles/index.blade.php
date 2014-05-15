<!--head-->
@include('../head')
<!--head end-->
<div class="container">
			<div id="menu">
			    <ul>
					@include('../navigation_bar')
				</ul>
		</div>

<h1><?php echo trans('messages.All Roles');?></h1>

<!-- will be used to show any messages -->

@if (Session::has('message'))
	<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<td>ID</td>
			<td><?php echo trans('messages.role_name');?></td>
			<td><?php echo trans('messages.permissions');?></td>
		</tr>
	</thead>
	<tbody>
	@foreach($roles as $key => $value)
		<tr>
			<td>{{ $value->id }}</td>
			<td>{{ $value->role_name }}</td>
			<td>@if ($value->serialized_permissions == 'N;'){{trans('messages.no permissions')}}@else{{ $value->serialized_permissions}}@endif</td>

			<td>

				<!-- delete role-->
				{{ Form::open(array('url' => 'roles/' . $value->id, 'class' => 'pull-right')) }}
					{{ Form::hidden('_method', 'DELETE') }}
					{{ Form::submit( trans('messages.Delete this Role'), array('class' => 'btn btn-warning')) }}
				{{ Form::close() }}
				<!-- show role-->
				<a class="btn btn-small btn-success" href="{{ URL::to('roles/' . $value->id) }}"><?php echo trans('messages.Show this Role');?></a>

				<!-- edit role-->
				<a class="btn btn-small btn-info" href="{{ URL::to('roles/' . $value->id . '/edit') }}"><?php echo trans('messages.Edit this Role');?></a>

			</td>
		</tr>
	@endforeach
	</tbody>
</table>

</div>
</body>
</html>