@extends('layouts.base')

@section('content')
    <div class="container">
        <nav class="mini-nav">
            <a href="#" class="active">Popular</a> / <a href="#">New</a>
        </nav>
        <section class="feed">
            @foreach($articles as $article)
            <article class="article panel">
                <a href="{{ $article->url }}" target="_blank">
                    <h2>{{ $article->title }}</h2>
                    <div class="article-content{{ ($article->image) ? ' has-image' : '' }}">
                        <p>{{ $article->summary }}</p>
                        @if(isset($article->image))
                        <div class="article-image">
                            <img src="{{ $article->image }}">
                        </div>
                        @endif
                    </div>
                </a>
            </article>
            @endforeach
        </section>
    </div>
@endsection