<!--head-->
@include('../head')
<!--head end-->
<div class="container">
			<div id="menu">
			    <ul>
					@include('../navigation_bar')
				</ul>
		</div>

<!-- if there are creation errors, they will show here -->

@if(isset($customer)) 
	{{ Form::model($customer, array('route' => array('customers.update', $customer->id), 'method' => 'PUT')) }}
	<h1><?php echo trans('messages.Customer Information');?></h1>
@else	
	{{ Form::open(array('url' => $action)) }}
	<h1><?php echo trans('messages.Create Customer');?></h1>
@endif


	<div class="form-group">
		{{ Form::label('first_name', trans('messages.firstname')) }}
		{{ Form::text('first_name', Input::old('first_name'), array('class' => 'form-control')) }}
		{{ $errors->first('first_name', '<span class="error">:message</span>') }}
	</div>
	
	<div class="form-group">
		{{ Form::label('last_name', trans('messages.lastname')) }}
		{{ Form::text('last_name', Input::old('last_name'), array('class' => 'form-control')) }}
		{{ $errors->first('last_name', '<span class="error">:message</span>') }}
	</div>
	
	<div class="form-group">
		{{ Form::label('company_name', trans('messages.company name')) }}
		{{ Form::text('company_name', Input::old('company_name'), array('class' => 'form-control')) }}
		{{ $errors->first('company_name', '<span class="error">:message</span>') }}
	</div>
	
	<div class="form-group">
		{{ Form::label('contact person', trans('messages.contact_person')) }}
		{{ Form::select('contact_person', $contacts_persons , Input::old('contacts_persons')) }}
		{{ $errors->first('contact_person', '<span class="error">:message</span>') }}
	</div>

	<div class="form-group">
		{{ Form::label('phone', trans('messages.phone')) }}
		{{ Form::text('phone', Input::old('phone'), array('class' => 'form-control')) }}
		{{ $errors->first('phone', '<span class="error">:message</span>') }}
	</div>
	
	<div class="form-group">
		{{ Form::label('telefax', trans('messages.telefax')) }}
		{{ Form::text('telefax', Input::old('telefax'), array('class' => 'form-control')) }}
		{{ $errors->first('telefax', '<span class="error">:message</span>') }}
	</div>
	
	<div class="form-group">
		{{ Form::label('email', trans('messages.email')) }}
		{{ Form::email('email', Input::old('email'), array('class' => 'form-control')) }}
		{{ $errors->first('email', '<span class="error">:message</span>') }}
	</div>
	
	<div class="form-group">
		{{ Form::label('street', trans('messages.street')) }}
		{{ Form::text('street', Input::old('street'), array('class' => 'form-control')) }}
		{{ $errors->first('street', '<span class="error">:message</span>') }}
	</div>
	
	<div class="form-group">
		{{ Form::label('house-number', trans('messages.house-number')) }}
		{{ Form::text('house_number', Input::old('house_number'), array('class' => 'form-control')) }}
		{{ $errors->first('house_number', '<span class="error">:message</span>') }}
	</div>
	
	<div class="form-group">
		{{ Form::label('city', trans('messages.city')) }}
		{{ Form::text('city', Input::old('city'), array('class' => 'form-control')) }}
		{{ $errors->first('city', '<span class="error">:message</span>') }}
	</div>
	
	<div class="form-group">
		{{ Form::label('zip_code', trans('messages.zip-code')) }}
		{{ Form::text('zip_code', Input::old('zip_code'), array('class' => 'form-control')) }}
		{{ $errors->first('zip_code', '<span class="error">:message</span>') }}
	</div>
	<div class="form-group">
		{{ Form::label('country', trans('messages.country')) }}
		{{ Form::select('country', $countries , Input::old('countries')) }}
		{{ $errors->first('country', '<span class="error">:message</span>') }}
	</div>

	{{ Form::submit(trans('messages.save'), array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

</div>
</body>
</html>