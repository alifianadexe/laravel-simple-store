<ul class="menu-sub">
    @foreach($category->children as $child)
        @include('layouts.menu-item', ['category' => $child])
    @endforeach
</ul>
