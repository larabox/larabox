@extends('layouts.master')

@section('body')
    <div class="modul__form_message row">

        <h1 class="text-center">Оставьте сообщенеие</h1>

        <div class="col-md-4 col-md-offset-4">

            @include('chunk.validator')

            <form method="POST" role="form">

                <div class="form-group">
                    <lable>Почта</lable>
                    <input class="form-control" name="email" type="text" value="{{old('email',Request::get('email'))}}"/>
                </div>

                <div class="form-group">
                    <lable>Телефон</lable>
                    <input class="form-control" name="telefon" type="text" value="{{old('telefon',Request::get('telefon'))}}"/>
                </div>

                <div class="form-group">
                    <lable>Имя</lable>
                    <input class="form-control" name="name" type="text" value="{{old('name',Request::get('name'))}}"/>
                </div>

                <br/>

                <input name="_token" type="hidden" value="{{csrf_token()}}"/>

                <div class="form-group">
                    <button class="btn btn-success btn-block" type="submit">Оставить</button>
                </div>


            </form>

        </div>
    </div>
@stop

