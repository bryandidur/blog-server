
@forelse ($articles as $article)
    <div class="card hoverable">
        <div class="card-content">
            <span class="card-title">
                <a href="{{ route('articles.show', ['slug' => $article->slug]) }}" title="{{ $article->title }}">
                    {{ $article->title }}
                </a>
            </span>
            <p class="description">{{ $article->description }}</p>

            @foreach ($article->tags as $artTag)
                <div class="chip">
                    <a href="{{ route('tags.show', ['slug' => $artTag->slug]) }}">{{ $artTag->name }}</a>
                </div>
            @endforeach
        </div>
        <div class="card-action">
            <a href="{{ route('articles.show', ['slug' => $article->slug]) }}">CONTINUAR LENDO</a>
        </div>
    </div>
@empty
    <p>Nenhum artigo foi encontrado.</p>
@endforelse

@if ( isset($isPaginating) && $isPaginating )
    <!-- Pagination render -->
    <div>{{ $articles->render() }}</div>
@endif

