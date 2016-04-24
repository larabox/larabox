@extends('layouts.master')

@section('body.content')
    <div class="modul__content">
        {!! parse_snippet($model->content_md) !!}
    </div>
@stop

@section('body.sidebar')
    <div class="modul__sidebar">
        @include('chunk.ul',['level'=>$controller->tree(),'index'=>0])
    </div>
@stop