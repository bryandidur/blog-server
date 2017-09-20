@extends('root')

@section('content')

<div class="col l8 xl9 article-page">
    <div class="card">
        <div class="card-content">
            <span class="card-title">
                @foreach ($article->categories as $artCategories)
                    <a href="{{ route('categories.show', ['slug' => $artCategories->slug]) }}">{{ $artCategories->name }}</a>
                @endforeach

                <h5 class="header">
                    <i class="material-icons valign-top">edit</i> {{ $article->title }}
                </h5>

                <div class="date">
                    <i class="material-icons valign-bottom">date_range</i>
                    <time datetime="{{ $article->created_at }}">{{ $article->created_at }}</time>
                </div>
            </span>

            <p class="description">{{ $article->description }}</p>
            <p class="content">{!! $article->content !!}</p>

            @foreach ($article->tags as $artTag)
                <div class="chip">
                    <a href="{{ route('tags.show', ['slug' => $artTag->slug]) }}">{{ $artTag->name }}</a>
                </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
