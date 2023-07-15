<li class="menu-item {{request()->path() == 'category/' . $category->full_slug ? 'active' : ''}}">
    <a href="{{ route('category', [$category->full_slug]) }}" class="menu-link {{$category->children->count() > 0 ? 'menu-toggle' : ''}}">
        <div data-i18n="Page 1">{{$category->name}}</div>
    </a>

    @if($category->children->count() > 0)
        @include('layouts.sub-menu', ['category' => $category])
    @endif
</li>
