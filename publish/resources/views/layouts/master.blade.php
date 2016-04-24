<!DOCTYPE html>
<html lang="ru">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{csrf_token()}}">

    <!--не выводить описание из яндекс каталога-->
    <meta name="robots" content="noyaca"/>
    <!--не выводить описание из DMOZ-->
    <meta name="robots" content="noodp"/>
    <meta name="descri" content="noodp"/>

    @section('head_seo')
        {!! SEO::generate() !!}
    @show

    <link href="/css/app.css" rel="stylesheet">

    @stack('head')
            <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


</head>
<body>

<div class="container__head">
    @section('head')
        @include('widgets.top_menu')
    @show
</div>

@section('body.top')
@show

<div class="container__body">
    @section('body')
        <div class="row">
            <div class="col-md-8">
                @section('body.content')
                @show
            </div>
            <div class="col-md-4">
                @section('body.sidebar')
                @show
            </div>
        </div>
    @show
</div>

<div class="container__footer">

</div>
@include('script.analitiks')
<script src="/js/all.js"></script>


@stack('script')

</body>
</html>