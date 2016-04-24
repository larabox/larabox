<div class="module__mini-cart text-center">
    <div class="empty @if($size) hidden @else show @endif">
        <a href="/cart/item">Ваша корзина пуста</a>
    </div>
    <div class="full @if($size) show @else hidden @endif">
        <a href="/cart/item">В корзине <span data-slot="cart-size" class="size">{{$size}}</span> шт</a>
        <p>На сумму: <span data-slot="cart-cost" class="cost">{{$cost}}</span>р</p>
    </div>
</div>