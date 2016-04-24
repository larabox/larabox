@extends('layouts.master')

@section('body')
    <div class="modul__profile row">

        <div class="col-md-4 col-md-offset-4">
            <h1>Личный кабинет</h1>

            <form method="POST" role="form">

                <div class="form-group @if($validator->messages()->first('email')) has-error @endif" >
                    <lable>Почта</lable>
                    <input class="form-control" disabled type="text" value="{{$user->email}}"/>
                    <em>{{$validator->messages()->first('email')}}</em>
                </div>

                <div class="form-group @if($validator->messages()->first('first_name')) has-error @endif" >
                    <lable>Имя</lable>
                    <input class="form-control" name="first_name" type="text" value="{{old('first_name',$user->first_name)}}"/>
                    <em>{{$validator->messages()->first('first_name')}}</em>
                </div>

                <div class="form-group @if($validator->messages()->first('last_name')) has-error @endif" >
                    <lable>Фомилия</lable>
                    <input class="form-control" name="last_name" type="text" value="{{old('last_name',$user->last_name)}}"/>
                    <em>{{$validator->messages()->first('last_name')}}</em>
                </div>

                @include('chunk.input.image_upload',['name'=>'avatar'])

                <hr/>

                <div class="form-group @if($validator->messages()->first('password')) has-error @endif" >
                    <lable>Новый пароль</lable>
                    <input class="form-control" name="password" type="password" value="{{old('password')}}"/>
                    <em>{{$validator->messages()->first('password')}}</em>
                </div>

                <div class="form-group @if($validator->messages()->first('password')) has-error @endif" >
                    <lable>Подтвердить пароль</lable>
                    <input class="form-control" name="password_confirmation" type="password" value="{{old('password_confirmation')}}"/>
                    <em>{{$validator->messages()->first('password')}}</em>
                </div>

                <input name="_token" type="hidden" value="{{csrf_token()}}"/>

                <div class="form-group">
                    <button class="btn btn-success btn-block" type="submit">Изменить</button>
                </div>

            </form>
        </div>
    </div>

@stop


