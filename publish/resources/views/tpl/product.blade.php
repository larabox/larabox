@extends('layouts.master')


@section('body.top')
    <div class="container__top_body container">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                    @foreach($controller->breadcrumbs() as $val)
                        <li><a href="{{$val->url}}">{{$val->label}}</a></li>
                    @endforeach
                </ol>
                <h1>{{$model->title}}</h1>
            </div>
        </div>
    </div>
@stop



@section('body.content')
    <div class="modul__content">
        <div class="row">
            <div class="col-md-6">

                @include('chunk.fotorama')

                <div class="fotorama" data-nav="thumbs" data-allowfullscreen="true">
                    @foreach($model->gallery as $val)
                        <img src="{{image_thumb_fit($val,400)}}" data-full="{{$val}}">
                    @endforeach
                </div>

            </div>
            <div class="col-md-6">
                {!! parse_snippet($model->content_md) !!}
            </div>
        </div>




    </div>

@stop

@section('body.sidebar')
    <div class="modul__sidebar">
        <div class="row">
            <div class="col-md-12">
                <div class="thumbnail">

                    <div class="caption">

                        <p class="h2 text-center text-info">Стоимость</p>

                        <p class="h3 text-danger text-center">{{$model->getCartField('price')}} руб.</p>

                        <p>
                            <a class="btn btn-danger btn-block"
                               data-cart-add="{{$model->id}}"
                               data-cart-action-val="Выполняется"
                               href="/cart/add/{{$model->id}}">Купить</a>
                        </p>

                        @if ($model->rest)
                            <p class="text-success text-center">На складе {{$model->rest}}шт</p>
                        @else
                            <p class="text-danger text-center">Под заказ</p>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('script')
<script src="http://ekobiomir.dev/js/cart.js"></script>
@endpush

@section('body')
    <div class="row">
        <div class="col-md-9">
            @section('body.content')
            @show
        </div>
        <div class="col-md-3">
            @section('body.sidebar')
            @show
        </div>
    </div>
@stop