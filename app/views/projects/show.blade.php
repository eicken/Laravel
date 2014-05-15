<!--head-->
@include('../head')
<!--head end-->
<div class="container">
			<div id="menu">
			    <ul>
					@include('../navigation_bar')
				</ul>
		</div>
<h1>{{ trans('messages.Showing')}} {{ $project->project_name}}</h1>

	<div class="jumbotron text-center">
		<table cellspacing="3">
			<tr><td>id:</td><td>{{ $project->id }}</td></tr>
			<tr><td>{{trans('messages.project_name')}}:</td><td>{{ $project->project_name}}</td></tr>
			<tr><td>{{trans('messages.company')}}:</td><td>{{ $project->company_name}}</td></tr>
			<tr><td>{{trans('messages.link')}}:</td><td>{{ $project->link}}</td></tr>
			<tr><td>{{trans('messages.description')}}:</td><td>{{ $project->description}}</td></tr>
			
		</table>
	</div>

</div>
</body>
</html>