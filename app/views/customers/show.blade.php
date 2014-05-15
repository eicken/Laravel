<!--head-->
@include('../head')
<!--head end-->
<div class="container">
			<div id="menu">
			    <ul>
					@include('../navigation_bar')
				</ul>
		</div>

	<div class="jumbotron text-center">
		<h4>{{trans('messages.customer data')}}</h4>
		<table cellspacing="3">
			<tr><td>id:</td><td>{{ $customer->id }}</td></tr>
			<tr><td>{{trans('messages.firstname')}}:</td><td>{{ $customer->first_name}}</td></tr>
			<tr><td>{{trans('messages.lastname')}}:</td><td>{{ $customer->last_name}}</td></tr>
			<tr><td>{{trans('messages.company name')}}:</td><td>{{ $customer->company_name}}</td></tr>
			<tr><td>{{trans('messages.customer_number')}}:</td><td>{{ $customer->customer_number}}</td></tr>
			<tr><td>{{trans('messages.phone')}}:</td><td>{{ $customer->phone}}</td></tr>
			<tr><td>{{trans('messages.telefax')}}:</td><td>{{ $customer->telefax}}</td></tr>
			<tr><td>{{trans('messages.email')}}:</td><td>{{ $customer->email}}</td></tr>
			<tr><td>{{trans('messages.contact_person')}}:</td><td>{{ $customer->contact_person_firstname}}&nbsp;{{ $customer->contact_person_lastname}}</td></tr>
		</table>
	</div>
	
		<div class="jumbotron text-center">
		<h4>{{trans('messages.customer address')}}</h4>
		<table cellspacing="3">
			<tr><td>{{trans('messages.street')}}:</td><td>{{ $customer->street}}</td></tr>
			<tr><td>{{trans('messages.house-number')}}:</td><td>{{ $customer->house_number}}</td></tr>
			<tr><td>{{trans('messages.city')}}:</td><td>{{ $customer->city}}</td></tr>
			<tr><td>{{trans('messages.zip-code')}}:</td><td>{{ $customer->zip_code}}</td></tr>
			<tr><td>{{trans('messages.country')}}:</td><td>{{ $customer->country_name}}</td></tr>
		</table>
	</div>

</div>
</body>
</html>