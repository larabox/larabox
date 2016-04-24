@extends('layouts.master')

@section('body')
    <div class="modul__login row">

        <div class="col-md-4 col-md-offset-4">
            <h1>Сбросить пароль</h1>

            @if($validator->messages()->first('status'))
                <p class="alert alert-danger">{{$validator->messages()->first('status')}}</p>
            @endif

            <form method="POST" role="form">

                <div class="form-group @if($validator->messages()->first('code')) has-error @endif" >
                    <lable>Код</lable>
                    <input class="form-control" name="code" type="text" value="{{old('code',Request::get('code'))}}"/>
                    <em>{{$validator->messages()->first('code')}}</em>
                </div>

                <div class="form-group @if($validator->messages()->first('password')) has-error @endif" >
                    <lable>Пароль</lable>
                    <input class="form-control" name="password" type="password" value="{{old('password',Request::get('password'))}}"/>
                    <em>{{$validator->messages()->first('password')}}</em>
                </div>

                <div class="form-group @if($validator->messages()->first('password')) has-error @endif" >
                    <lable>Повторить пароль</lable>
                    <input class="form-control" name="password_confirmation" type="password" value="{{old('password_confirmation',
                    Request::get
                    ('password_confirmation'))}}"/>
                    <em>{{$validator->messages()->first('password')}}</em>
                </div>

                <input name="_token" type="hidden" value="{{csrf_token()}}"/>

                <div class="form-group">
                    <button class="btn btn-success btn-block" type="submit">Сбросить пароль</button>
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