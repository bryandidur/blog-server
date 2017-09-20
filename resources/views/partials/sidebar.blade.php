<div class="col l4 xl3 sidebar">
    <div class="row">
        <div class="col s12">
            <ul class="collection with-header">
                <li class="collection-header">
                    <i class="material-icons valign-bottom">folder_open</i> Categorias
                </li>

                @foreach ($composer->categories as $category)
                    <a class="collection-item" title="Categoria {{ $category->name }}"
                        href="{{ route('categories.show', ['slug' => $category->slug]) }}"
                    >{{ $category->name }}</a>
                @endforeach
            </ul>
        </div>

        <div class="col s12">
            <ul class="collection with-header">
                <li class="collection-header">
                    <i class="material-icons valign-bottom">label_outline</i> Tags
                </li>

                @foreach ($composer->tags as $tag)
                    <a class="collection-item" title="Tag {{ $tag->name }}"
                        href="{{ route('tags.show', ['slug' => $tag->slug]) }}"
                    >{{ $tag->name }}</a>
                @endforeach
            </ul>
        </div>
    </div><!-- / .row -->
</div>
