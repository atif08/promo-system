@foreach($menus as $menu)

    @continue(isset($menu['hidden']) && (
	    (is_callable($menu['hidden']) && call_user_func($menu['hidden'], $user)) ||
        (is_bool($menu['hidden']) && $menu['hidden'])))

    <li class="menu-title"> <span>{{ $menu['title'] }}</span></li>

    @foreach($menu['children'] as $child)

        @continue(isset($child['hidden']) && (
			(is_callable($child['hidden']) && call_user_func($child['hidden'], $user)) ||
			(is_bool($child['hidden']) && $child['hidden'])))

        @php $url = 'javascript:;'; @endphp
        @isset($child['url'])
            @php $url = url($child['url']) . (request()->has('t') ? ('?t=' . request()->get('t')) : ''); @endphp
        @endisset

        <li>
            <a href="{{ $url }}" class="@if(is_menu_parent($child)) has-arrow @endif waves-effect">
                <i class="{{ $child['icon'] }}"></i>
                <span>{{ $child['title'] }}</span>
            </a>

            @if(isset($child['children']))
                <ul class="sub-menu mm-collapse" aria-expanded="false">

                    @foreach($child['children'] as $sub_child)

                        @continue(isset($sub_child['hidden']) && (
				            (is_callable($sub_child['hidden']) && call_user_func($sub_child['hidden'], $user)) ||
                            (is_bool($sub_child['hidden']) && $sub_child['hidden'])))

                        @php $url = 'javascript:;'; @endphp
                        @isset($sub_child['url'])
                            @php $url = url($sub_child['url']) . (request()->has('t') ? ('?t=' . request()->get('t')) : ''); @endphp
                        @endisset

                        <li><a href="{{ $url }}">{{ $sub_child['title'] }}</a></li>
                    @endforeach`
                </ul>
            @endif
        </li>

    @endforeach

@endforeach
