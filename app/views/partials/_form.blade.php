
@section('form')

<h3>Add new Authorised Host</h3>

{{ Form::open() }}

<div class="form-group">
	{{ Form::label('ipaddress', 'IP Address:') }}
	{{ Form::text('ipaddress', null, ['class' => 'form-control']) }}
	{{ $errors->first('ipaddress', '<div class="error">:message</div>') }}
</div><!-- end form-group -->

<div class="form-group">
	{{ Form::label('subnet', 'Subnet:') }}
	{{ Form::text('subnet', null, ['class' => 'form-control']) }}
	{{ $errors->first('subnet', '<div class="error">:message</div>') }}
</div><!-- end form-group -->
	
<div class="form-group">
	{{ Form::label('description', 'Description:') }}
	{{ Form::textarea('description', null, ['class' => 'form-control']) }}
	{{ $errors->first('description', '<div class="error">:message</div>') }}
</div><!-- end form-group -->

<div class="form-group">
	{{ Form::label('enabled', 'Enabled:') }}
	{{ Form::checkbox('enabled', 1) }}
</div><!-- end form-group -->

<div class="form-group">
	
	{{ Form::submit('Add', ['class' => 'form-send btn btn-primary']) }}
</div><!-- end form-group -->

{{ Form::close() }}

@show