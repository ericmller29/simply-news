@extends('layouts.base')

@section('content')
    <div class="container">
        <nav class="mini-nav">
            <a href="#" class="active">Popular</a> / <a href="#">New</a>
        </nav>
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
        <section class="feed">
            @foreach($articles as $article)
            <article class="article panel">
                <a href="{{ $article->url }}" target="_blank">
                    @if(isset($article->image))
                    <div class="article-image with-margin-bottom">
                        <img src="{{ $article->image }}">
                    </div>
                    @endif
                    <h2>{{ $article->title }}</h2>
                    <div class="article-content">
                        <p>{{ $article->summary }}</p>
                    </div>
                    <span class="source"><em>Source: {{ $article->source->name }}</em></span>
                </a>
            </article>
            @endforeach
        </section>
    </div>
@endsection