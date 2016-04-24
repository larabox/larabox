@extends('layouts.email')

@section('body')

    <!-- content -->
    <div class="content">
        <h1>Заявка на сайте</h1>
        <p>Почта:<strong>{{$email}}</strong></p>
        <p>Телефон:<strong>{{$telefon}}</strong></p>
        <p>Имя:<strong>{{$name}}</strong></p>
    </div><!-- /content -->

@stop