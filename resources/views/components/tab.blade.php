<div class="{{ $class }} ">
    <!-- Nav tabs -->
    <ul class="nav  nav-tabs {{ $innerClass }}" id="{{ $id }}" role="tablist">
        @foreach ($tabs as $item)
            <li class="nav-item">
                <a @class(['nav-link', 'active' => $active === $item])id="{{ $item }}-tab-fill" data-toggle="tab"
                    href="#{{ $item }}-fill" role="tab" aria-controls="{{ $item }}-fill"
                    aria-selected="true">{{ Str::of($item)->replace(['_', '-'], ' ')->ucfirst() }}</a>
            </li>
        @endforeach

    </ul>

    <!-- Tab panes -->
    <div class="tab-content pt-1">

        @foreach ($tabs as $item)
            <div @class(['tab-pane', 'active' => $active === $item]) id="{{ $item }}-fill" role="tabpanel"
                aria-labelledby="{{ $item }}-tab-fill">
                {{ $$item ?? 'No content for ' . $item }}
            </div>
        @endforeach

    </div>
</div>
