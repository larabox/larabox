<div class="nav navbar-nav navbar-right">
    @include('widgets.mini_cart')
</div>

<ul class="nav navbar-nav navbar-right">
    @if(Sentinel::check())
    <li>
        <a href="{{route('profile')}}">Личный кобинет</a>
    </li>
    <li>
        <a href="{{route('logout')}}">Выход</a>
    </li>
    @else
        <li>
            <a href="{{route('registration')}}">Регистрация</a>
        </li>
        <li>
            <a href="{{route('login')}}">Вход</a>
        </li>
    @endif
</ul>