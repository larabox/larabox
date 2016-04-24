@extends('layouts.master')

@section('body')
    <div class="module__cart row">
        <div class="col-md-6 col-md-offset-3">
            <h1>Корзина</h1>

            <div class="module__cart-items">
                @include('chunk.cart.list_item',['collection'=>$collection])
            </div>

            <div class="text-right">
                <p class="text-success h4">Общая стоимость: <span data-slot="cart-cost">{{$cost}}р</span></p>
            </div>

            <div class="text-right">
                <a class="btn btn-default" href="/cart/drop">Очистить корзину</a>
                <a class="btn btn-success" href="/cart/bay">Продолжить покупку</a>
            </div>
        </div>
    </div>
@stop

@push('script')
    <script src="{{asset('js/cart.js')}}"></script>
@endpush
