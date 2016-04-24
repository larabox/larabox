<nav class="navbar navbar-default" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{route('home')}}">LaraBox</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">

                <li @if(Route::currentRouteName() == 'home')class="active" @endif >
                    <a href="{{route('home')}}">Главная</a>
                </li>

                <li @if(in_array(Route::currentRouteName(),['category','post']))class="active" @endif >
                    <a href="{{route('category')}}">Статьи</a>
                </li>

                <li @if(in_array(Route::currentRouteName(),['catalog','product']))class="active" @endif >
                    <a href="{{route('catalog')}}">Каталог</a>
                </li>

                <li @if(Route::currentRouteName() == 'contact')class="active" @endif >
                    <a href="{{route('contact')}}">Контакты</a>
                </li>

            </ul>

            @include('widgets.top_menu_right')

        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>