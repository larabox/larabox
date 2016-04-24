@extends('layouts.master')

@section('body.content')
    <div class="module__list">
        @foreach($controller->collections() as $val)
            <div class="row">
                <div class="col-md-3 text-center">
                    <a href="{{$val->url}}">
                        <img class="img-responsive lazy" style="margin:auto"
                             src="/img/lazyload.gif"
                             data-original="{{image_thumb_resize_canvas($val->image,150)}}"
                             alt="{{$val->title}}">
                    </a>
                </div>

                <div class="col-md-6">
                    <a href="{{$val->url}}">
                        <h4 class="media-heading">{{$val->title}}</h4>
                    </a>

                    <p>{{$val->description}}</p>

                </div>
                <div class="col-md-3 text-center">

                    <p class="h3 text-danger">{{$val->getCartField('price')}} р.</p>

                    <div>
                        <a href="{{$val->url}}">Подробнее</a>
                    </div>
                    <div>
                        <a data-cart-add="{{$val->id}}" data-cart-action-val="Выполняется" class="btn btn-info"
                           href="/cart/add/{{$val->id}}">В корзину</a>
                    </div>
                    @if ($val->rest)
                        <p class="text-success">На складе {{$val->rest}} шт.</p>
                    @else
                        <p class="text-danger">Под заказ</p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <hr/>
                </div>
            </div>

        @endforeach
        {!! $controller->collections()->appends(request()->all())->links() !!}

    </div>
@stop

@section('body.sidebar')
    <div class="module__sidebar">
        @include('chunk.ul',['level'=>$controller->tree(),'index'=>0])

    </div>

@stop

@push('script')
<script src="{{asset('js/cart.js')}}"></script>
@include('script.lazyload')
@endpush