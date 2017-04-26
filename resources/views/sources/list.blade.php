@extends('layouts.base')

@section('content')
	<div class="container wide">
		<div class="panel">
			<div class="panel-heading with-margin-bottom">Your Sources</div>
			<table class="with-margin-bottom">
				<thead>
					<tr>
						<th>Name</th>
						<th>Feed</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach(Auth::user()->sources as $s)
					<tr>
						<td>{{ $s->name }}</td>
						<td>{{ $s->rss }}</td>
						<td class="action">
							<a href="{{ url('/sources/delete/' . $s->id) }}"><i class="fa fa-trash"></i></a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			<div class="text-right">
				<a href="/sources/add" class="btn">Add Source</a>
			</div>
		</div>
	</div>
@endsection