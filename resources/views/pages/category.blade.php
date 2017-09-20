@extends('root')

@section('content')

<div class="col l8 xl9 tag-page">
    <h5 class="header">
        <i class="material-icons valign-top">folder_open</i> {{ $category->name }}
    </h5>

    @include('pages.partials.articles-cards', ['articles' => $articles, 'isPaginating' => true])
</div>

@endsection
