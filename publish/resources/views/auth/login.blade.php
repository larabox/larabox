@extends('layouts.master')

@section('body')
    <div class="modul__login row">

        <div class="col-md-4 col-md-offset-4">
            <h1>Авторизация</h1>

            @include('chunk.validator')

            <form method="POST" role="form">

                <div class="form-group @if($validator->messages()->first('email')) has-error @endif" >
                    <lable>Почта</lable>
                    <input class="form-control" name="email" type="text" value="{{old('email',Request::get('email'))}}"/>
                    <em>{{$validator->messages()->first('email')}}</em>
                </div>

                <div class="form-group @if($validator->messages()->first('password')) has-error @endif" >
                    <lable>Пароль</lable>
                    <input class="form-control" name="password" type="password" value="{{old('password',Request::get('password'))}}"/>
                    <em>{{$validator->messages()->first('password')}}</em>
                </div>

                <div class="checkbox">
                    <label>
                        <input name="remembor" type="checkbox"> Запоминить
                    </label>
                </div>


                <input name="_token" type="hidden" value="{{csrf_token()}}"/>

                <div class="form-group">
                    <button class="btn btn-success btn-block" type="submit">Войти</button>
                </div>

                <div class="link">
                    <div class="col-md-6 text-left">
                        <a href="{{route('password.reset')}}">Востоновить пароль</a>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="{{route('registration')}}">Регистрация</a>
                    </div>
                </div>

            </form>

        </div>
    </div>
@stop