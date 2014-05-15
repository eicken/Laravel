<!--head-->
@include('../head')
<!--head end-->
<div class="container">
			<div id="menu">
			    <ul>
					@include('../navigation_bar')
				</ul>
		</div>

<h1><?php echo trans('messages.All the Customers');?></h1>

<!-- will be used to show any messages -->

@if (Session::has('message'))
	<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<td>ID</td>
			<td><?php echo trans('messages.Company name');?></td>
			<td><?php echo trans('messages.firstname');?></td>
			<td><?php echo trans('messages.lastname');?></td>
		</tr>
	</thead>
	<tbody>
	@foreach($customers as $key => $value)
		<tr>
			<td>{{ $value->id }}</td>
			<td>{{ $value->company_name }}</td>
			<td>{{ $value->first_name }}</td>
			<td>{{ $value->last_name }}</td>

			<!-- we will also add show, edit, and delete buttons -->
			<td>

				<!-- delete the nerd (uses the destroy method DESTROY /nerds/{id} -->
				<!-- we will add this later since its a little more complicated than the other two buttons -->
				{{ Form::open(array('url' => 'customers/' . $value->id, 'class' => 'pull-right')) }}
					{{ Form::hidden('_method', 'DELETE') }}
					{{ Form::submit( trans('messages.Delete this Customer'), array('class' => 'btn btn-warning')) }}
				{{ Form::close() }}
				<!-- show the nerd (uses the show method found at GET /nerds/{id} -->
				<a class="btn btn-small btn-success" href="{{ URL::to('customers/' . $value->id) }}"><?php echo trans('messages.Show this Customer');?></a>

				<!-- edit this nerd (uses the edit method found at GET /nerds/{id}/edit -->
				<a class="btn btn-small btn-info" href="{{ URL::to('customers/' . $value->id . '/edit') }}"><?php echo trans('messages.Edit this Customer');?></a>

			</td>
		</tr>
	@endforeach
	</tbody>
</table>

</div>
</body>
</html>