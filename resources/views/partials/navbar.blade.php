<nav class="light-blue lighten-" role="navigation">
    <div class="nav-wrapper container">
        <a class="brand-logo" href="{{ route('home.index') }}"><i class="material-icons">edit</i> Blog</a>
        <a class="button-collapse nofollow" data-activates="nav-mobile"><i class="material-icons">menu</i></a>

        <!-- Desktop Menu -->
        <ul class="right hide-on-med-and-down">
            <li> <!-- Home -->
                <a href="{{ route('home.index') }}">Início</a>
            </li>

            <li> <!-- Tags -->
                <a class="dropdown-button nofollow" data-activates="tags-dropdown">
                    Tags <i class="material-icons right">arrow_drop_down</i>
                </a>
                <ul id="tags-dropdown" class="dropdown-content">
                    @forelse ($composer->tags as $tag)
                        <li>
                            <a href="{{ route('tags.show', ['slug' => $tag->slug]) }}" title="Tag {{ $tag->name }}">{{ $tag->name }}</a>
                        </li>
                    @empty
                        <li><a class="nofollow">Sem tags</a></li>
                    @endforelse
                </ul>
            </li>

            <li> <!-- Categories -->
                <a class="dropdown-button nofollow" data-activates="categories-dropdown">
                    Categorias <i class="material-icons right">arrow_drop_down</i>
                </a>
                <ul id="categories-dropdown" class="dropdown-content">
                    @forelse ($composer->categories as $category)
                        <li>
                            <a href="{{ route('categories.show', ['slug' => $category->slug]) }}" title="Categoria {{ $category->name }}">{{ $category->name }}</a>
                        </li>
                    @empty
                        <li><a class="nofollow">Sem categorias</a></li>
                    @endforelse
                </ul>
            </li>
        </ul>
    </div>
</nav>

<!-- Mobile Menu -->
<ul id="nav-mobile" class="side-nav">
    <li> <!-- Home -->
        <a href="{{ route('home.index') }}">Início</a>
    </li>

    <li> <!-- Tags -->
        <ul class="collapsible collapsible-accordion">
            <li>
                <a class="collapsible-header">
                    Tags <i class="material-icons right">arrow_drop_down</i>
                </a>
                <div class="collapsible-body">
                    <ul>
                        @forelse ($composer->tags as $tag)
                            <li>
                                <a href="{{ route('tags.show', ['slug' => $tag->slug]) }}" title="Categoria {{ $tag->name }}">{{ $tag->name }}</a>
                            </li>
                        @empty
                            <li><a class="nofollow">Sem tags</a></li>
                        @endforelse
                    </ul>
                </div>
            </li>
        </ul>
    </li>

    <li> <!-- Categories -->
        <ul class="collapsible collapsible-accordion">
            <li>
                <a class="collapsible-header">
                    Categorias <i class="material-icons right">arrow_drop_down</i>
                </a>
                <div class="collapsible-body">
                    <ul>
                        @forelse ($composer->categories as $category)
                            <li>
                                <a href="{{ route('categories.show', ['slug' => $category->slug]) }}" title="Categoria {{ $category->name }}">{{ $category->name }}</a>
                            </li>
                        @empty
                            <li><a class="nofollow">Sem categorias</a></li>
                        @endforelse
                    </ul>
                </div>
            </li>
        </ul>
    </li>
</ul>
