@extends('layouts.master')

@section('body')
    <div class="row">
        <div class="col-md-12 text-center">
            <h1 class="text-danger">404</h1>
            <p>Такой страници не найдено</p>
            <a href="{{route('home')}}">На главную</a>
        </div>
    </div>
@stop