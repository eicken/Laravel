<!--head-->
@include('../head')
<!--head end-->
<div class="container">
			<div id="menu">
			    <ul>
					@include('../navigation_bar')
				</ul>
		</div>
<h1>{{ trans('messages.Showing')}} {{ $user->last_name }}</h1>

	<div class="jumbotron text-center">
		<table cellspacing="3">
			<tr><td>id:</td><td>{{ $user->id }}</td></tr>
			<tr><td>{{trans('messages.greeting')}}:</td><td>{{ $user->greeting}}</td></tr>
			<tr><td>{{trans('messages.lastname')}}:</td><td>{{ $user->last_name}}</td></tr>
			<tr><td>{{trans('messages.firstname')}}:</td><td>{{ $user->first_name}}</td></tr>
			<tr><td>{{trans('messages.email-address')}}:</td><td>{{ $user->email}}</td></tr>
			<tr><td>{{trans('messages.phone')}}:</td><td>{{ $user->phone}}</td></tr>
			<tr><td>{{trans('messages.role')}}:</td><td>{{ $user_role_name[0]->role_name}}</td></tr>
			<tr><td>{{trans('messages.customer')}}:</td><td>{{ $user_customer_name[0]->company_name}}</td></tr>
			
		</table>
	</div>

</div>
</body>
</html>