@extends('layouts.master')

@section('body')

    <div class="jet-module__cart-bay row">
        <div class="col-md-4 col-md-offset-4">

            <h1>Оформление заказа</h1>

            @include('chunk.validator')

            <form action="/cart/bay" method="POST">

                <div class="form-group">
                    <label>Ваше Ф.И.О.</label>
                    <input name="name" type="text" class="form-control"  placeholder="Введите ваше имя" value="{{old('name')}}">
                </div>

                <div class="form-group">
                    <label>Ваше телефон</label>
                    <input name="telefon" type="text" class="form-control" placeholder="Введите ваше телефон" value="{{old
                    ('telefon')}}">
                </div>

                <div class="form-group">
                    <label>Способ доставки</label>
                    <select name="dostavka" class="form-control">
                        <option value="samovivoz" @if(old('dostavka') == 'samovivoz') selected @endif>Самовывоз</option>
                        <option value="dostavka" @if(old('dostavka') == 'dostavka') selected @endif>Доставка на дом</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Адрес доставки если требуется</label>
                    <textarea name="adress" class="form-control"  placeholder="Введите ваше адрес">{{old('adress')}}</textarea>
                </div>

                <input type="hidden" name="_token" value="{{csrf_token()}}">

                <br/>

                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-block">Оформить</button>
                </div>

            </form>

        </div>
    </div>

@stop