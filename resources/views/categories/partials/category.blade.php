<li class="list-group-item">
    @if ($category->children->isNotEmpty())
        <a href="#category-{{ $category->id }}" data-toggle="collapse" aria-expanded="false"
            aria-controls="category-{{ $category->id }}">
            {{ $category->name }}
        </a>
        <div class="collapse" id="category-{{ $category->id }}">
            <ul class="list-group">
                @foreach ($category->children as $child)
                    @include('categories.partials.category', ['category' => $child])
                @endforeach
            </ul>
        </div>
    @else
        {{ $category->name }}
    @endif
</li>
