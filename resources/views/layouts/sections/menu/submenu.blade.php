<ul class="menu-sub">
    @if (isset($menu))
        @foreach ($menu as $submenu)
            {{-- active menu method --}}
            @php
                $activeClass = null;
                $active = 'active open';
                $currentRouteName = Route::currentRouteName();

                if ($currentRouteName === $submenu->slug) {
                    $activeClass = 'active';
                } elseif (isset($submenu->submenu)) {
                    if (gettype($submenu->slug) === 'array') {
                        foreach ($submenu->slug as $slug) {
                            if (str_contains($currentRouteName, $slug) and strpos($currentRouteName, $slug) === 0) {
                                $activeClass = $active;
                            }
                        }
                    } else {
                        if (str_contains($currentRouteName, $submenu->slug) and strpos($currentRouteName, $submenu->slug) === 0) {
                            $activeClass = $active;
                        }
                    }
                }
            @endphp

            <li class="ms-3 menu-item {{ $activeClass }}">
                <a data-slug="{{ $submenu->slug }}"
                    href="{{ isset($submenu->url) ? url($submenu->url) : 'javascript:void(0)' }}"
                    class="{{ isset($submenu->submenu) ? 'menu-link menu-toggle myMenu' : 'menu-link myMenu' }}"
                    @if (isset($submenu->target) and !empty($submenu->target)) target="_blank" @endif>
                    @if (isset($submenu->icon))
                        {{-- <i class=" ms-3 {{ $submenu->icon }}"></i> --}}
                    @endif
                    <div class="">{{ isset($submenu->name) ? __($submenu->name) : '' }}</div>
                </a>

                @php
                    $values = ['APTITUDE', 'PHP', 'PYTHON', 'JAVA', 'ANGULAR']; // change the skills dynamically from the table.

                    $skillImages = [
                        'APTITUDE' => 'aptitude.jpg',
                        'PHP' => 'php.png',
                        'PYTHON' => 'python.png',
                        'JAVA' => 'java.png',
                        'ANGULAR' => 'angular.png',
                    ];
                @endphp

                {{-- jquery for this was writtened in footer --}}
                @if ($submenu->slug == 'filter-questions')
                    <div id="skillsList">
                        <ul style="list-style-type: none;">
                            @foreach ($values as $value)
                                <li>
                                    <img src="{{ asset('assets/img/lang-icons/' . $skillImages[$value]) }}" height="22"
                                        width="22" class="mx-1" alt="">
                                    <a class="text-white "
                                        href="{{ url('admin/skills/' . strtolower($value)) }}">{{ strtoupper($value) }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- submenu --}}
                @if (isset($submenu->submenu))
                    @include('layouts.sections.menu.submenu', ['menu' => $submenu->submenu])
                @endif
            </li>
        @endforeach
    @endif
</ul>
