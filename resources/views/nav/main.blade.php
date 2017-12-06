@foreach($menu as $el)
    <li>
        <a href="{{ $el->url() }}">{{ $el->name }}</a>
        @if($el->children->count() > 0 && $level == 0)
            <ul class="dropdown">
                @include('nav.main', ['menu' => $el->children, 'level' => $level + 1])
            </ul>
        @endif
    </li>
@endforeach