@forelse($collection as $val)


    <div class="row">

        <div class="col-md-3 image">
            <a href="{{$val->getCartField('url')}}">
                <img class="img-responsive" src="/{{image_thumb_resize_canvas($val->getCartField('image'),150)}}"
                 alt="{{$val->getCartField
            ('title')}}">
            </a>
        </div>

        <div class="col-md-6 desc">
            <a href="{{$val->getCartField('url')}}">
                <h3 class="media-heading">{{$val->getCartField('title')}}</h3>
            </a>
            <p>{{$val->getCartField('description')}}</p>
        </div>

        <div class="col-md-3 text-center info">
            <div class="amount">
                <lable>Вколичестве</lable>
                <p class="h2 text-success media-heading">{{$val->getCartField('amount')}} шт</p>
            </div>

            <hr class="media-heading"/>

            <div class="cost">
                <div>
                    <lable>Цена</lable>
                </div>
                <em class="text-info media-heading func">{{$val->getCartField('price')}}р * {{$val->getCartField
                ('amount')}}шт</em>
                <p class="h5 text-success media-heading summ">{{$val->getCartField('cost')}}р</p>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="text-right control">
            <a class="btn btn-danger btn-sm"
               data-cart-clear="{{$val->getCartField('id')}}"
               data-cart-action-val="Выполняется"
               class="clear" href="/cart/clear/{{$val->getCartField('id')}}">Убрать</a>
            <a class="btn btn-danger btn-sm"
               data-cart-remove="{{$val->getCartField('id')}}"
               data-cart-action-val="Удаляем"
               class="remove" href="/cart/remove/{{$val->getCartField('id')}}">-</a>
            <a class="btn btn-success btn-sm"
               data-cart-add="{{$val->getCartField('id')}}"
               data-cart-action-val="Добовляем"
               class="add" href="{{route('cart.add',$val->getCartField('id'))}}">+</a>
        </div>
        <hr/>
    </div>

@empty

   <div class="row">
       <div class="empty">
           <h3>В корзине пусто</h3>
       </div>
   </div>

@endforelse