@extends('layouts.base')

@section('content')
    <div class="container">
        <nav class="mini-nav">
            <a href="#" class="active">Popular</a> / <a href="#">New</a>
        </nav>
        @if(Auth::check())
        <form>
            <dashboard-filter inline-template filter="{{ $source_id }}">
                <div class="select with-margin-bottom">
                    <select v-on:change="filterNews()" v-model="filter">
                        <option value="">Filter your news</option>
                        @foreach($sources as $s)
                        <option value="{{ $s->id }}">{{ $s->name }}</option>
                        @endforeach
                    </select>
                </div>
            </dashboard-filter>
        </form>
        @endif
        <simply-articles articles="{{ $articles }}" filter="{{ $source_id }}"></simply-articles>
    </div>
@endsection