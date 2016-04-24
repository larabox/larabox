@extends('layouts.master')

@section('body')
    <div class="modul__login row">

        <div class="col-md-4 col-md-offset-4">
            <h1>Сбросить пароль</h1>

            @if($validator->messages()->first('status'))
                <p class="alert alert-danger">{{$validator->messages()->first('status')}}</p>
            @endif

            <form method="POST" role="form">

                <div class="form-group @if($validator->messages()->first('email')) has-error @endif" >
                    <lable>Почта</lable>
                    <input class="form-control" name="email" type="text" value="{{old('email',Request::get('email'))}}"/>
                    <em>{{$validator->messages()->first('email')}}</em>
                </div>

                <input name="_token" type="hidden" value="{{csrf_token()}}"/>

                <div class="form-group">
                    <button class="btn btn-success btn-block" type="submit">Сменить пароль</button>
                </div>

                <div class="link">
                    <div class="col-md-6 text-left">
                        <a href="{{route('login')}}">Авторизоватся</a>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="{{route('registration')}}">Регистрация</a>
                    </div>
                </div>

            </form>

        </div>
    </div>
@stop