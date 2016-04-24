@extends('layouts.master')

@section('body.content')
    <div class="module__list">
        @foreach($controller->collections() as $val)
            <div class="row">
                <div class="col-md-3 text-center">
                    <a href="{{$val->url}}">
                        <img
                                class="img-responsive lazy"
                                src="/img/lazyload.gif"
                                data-original="{{image_thumb_resize_canvas($val->image,150)}}"
                                alt="{{$val->title}}">
                    </a>
                </div>
                <div class="col-md-9">
                    <a href="{{$val->url}}">
                        <h4 class="media-heading">{{$val->title}}</h4>
                    </a>

                    <p>{{$val->description}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="text-right">
                        <a class="btn btn-info btn-xs" href="{{$val->url}}">Подробнее...</a>
                    </div>
                    <hr/>
                </div>
            </div>
        @endforeach
        {!! $controller->collections()->render() !!}
    </div>
@stop

@section('body.sidebar')
    <div class="module__sidebar">
        @include('chunk.ul',['level'=>$controller->tree(),'index'=>0])
    </div>
@stop

@push('script')
@include('script.lazyload')
@endpush

