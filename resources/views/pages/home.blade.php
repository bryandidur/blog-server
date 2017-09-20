@extends('root')

@section('content')

<div class="col l8 xl9">
    @include('pages.partials.articles-cards', ['articles' => $articles, 'isPaginating' => true])
</div>

@endsection
