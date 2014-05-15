<!--head-->
@include('../head')
<!--head end-->
<div class="container">
			<div id="menu">
			    <ul>
					@include('../navigation_bar')
				</ul>
		</div>
<h1>{{ trans('messages.Showing')}} {{ $role->role_name }}</h1>

	<div class="jumbotron text-center">
		<table cellspacing="3">
			<tr><td>id:</td><td>{{ $role->id }}</td></tr>
			<tr><td>{{trans('messages.role_name')}}:</td><td>{{ $role->role_name}}</td></tr>
			<tr><td>{{trans('messages.permissions')}}:</td><td>{{ $role->serialized_permissions}}</td></tr>			
		</table>
	</div>

</div>
</body>
</html>