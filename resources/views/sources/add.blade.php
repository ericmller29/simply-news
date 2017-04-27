@extends('layouts.base')

@section('content')
	<div class="container">
		<div class="panel">
			<div class="panel-heading with-margin-bottom">Add new source</div>
			<form action="/sources/add" method="POST">
            	{{ csrf_field() }}
            	<div class="form-input with-margin-bottom{{ $errors->has('rss') ? ' has-error' : '' }}">
            		<label for="rss">Source Feed:</label>
            		<input type="text" name="rss" id="rss" value="{{ old('rss') }}">
	                @if ($errors->has('rss'))
	                    <span class="help-block">
	                        {{ $errors->first('rss') }}
	                    </span>
	                @endif
            	</div>
            	<div class="form-input with-margin-bottom">
            		<label for="local">Local news feed?</label>
            		<input type="checkbox" name="local" id="local">
            	</div>
            	<div class="form-input text-center">
            		<button type="submit" class="btn">Add Source</button>
            	</div>
			</form>
		</div>
	</div>
@endsection