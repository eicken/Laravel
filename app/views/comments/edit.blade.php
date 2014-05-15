	
	@if(isset($comment)) 
	{{ Form::model($comment, array('route' => array('comments.update', $comment->id), 'method' => 'PUT', 'files' => true)) }}
	<h1><?php echo trans('messages.edit comment');?></h1>
	@else	
	{{ Form::open(array('url' => $action)) }}
	<h1><?php echo trans('messages.Write Comment');?></h1>
	@endif

	<div class="form-group" id="modal_div">
		{{ Form::label('comment', trans('messages.your Comment')) }}
		{{ Form::textarea('comment', Input::old('comment'), array('class' => 'form-control', 'required'=>"required", 'rows'    => 2, )) }}
		{{ $errors->first('comment', '<span class="error">:message</span>') }}
	</div>
	
	
	{{ Form::button(trans('messages.close'), array('class' => 'btn btn-default', 'data-dismiss'=>'modal')) }}
	{{ Form::submit(trans('messages.save'), array('class' => 'btn btn-primary', 'id'=>'submit')) }}
{{ Form::close() }}
