if (jet === undefined){
    var jet = {};
}

jet.cart = {
    old_val: {
        add: ''
    },
    refresh: function(el,json){
        if ($('.module__cart-items').length !== 0) {
            $.post('/cart/item', {'_token': $('meta[name="csrf-token"]').attr('content')})
                .done(function (html) {
                    $('.module__cart-items').html(html);
                });
        }

        if (json.size>0){
            if ($('.module__mini-cart .empty').hasClass('show')) {
                $('.module__mini-cart .empty').toggleClass('show hidden');
            }
            if ($('.module__mini-cart .full').hasClass('hidden')) {
                $('.module__mini-cart .full').toggleClass('hidden show');
            }
        }else{
            if ($('.module__mini-cart .empty').hasClass('hidden')) {
                $('.module__mini-cart .empty').toggleClass('show hidden');
            }
            if ($('.module__mini-cart .full').hasClass('show')) {
                $('.module__mini-cart .full').toggleClass('hidden show');
            }
        }

        $('[data-slot=cart-size]').html(json.size);
        $('[data-slot=cart-cost]').html(json.cost);
    },
    event:{
        add:function(el,json){
            jet.cart.refresh(el,json);
            $(el).removeClass('disabled');
            $(el).html(jet.cart.old_val.add);
        },
        remove:function(el,json){
            jet.cart.refresh(el,json);
            $(el).removeClass('disabled');
            $(el).html(jet.cart.old_val.add);
        },
        clear:function(el,json){
            jet.cart.refresh(el,json);
            $(el).removeClass('disabled');
            $(el).html(jet.cart.old_val.add);
        },
        pre_add:function(el){
            $(el).addClass('disabled');
            jet.cart.old_val.add = $(el).html();
            $(el).html($(el).attr('data-cart-action-val'));
        },
        pre_remove:function(el){
            $(el).addClass('disabled');
            jet.cart.old_val.add = $(el).html();
            $(el).html($(el).attr('data-cart-action-val'));
        },
        pre_clear:function(el){
            $(el).addClass('disabled');
            jet.cart.old_val.add = $(el).html();
            $(el).html($(el).attr('data-cart-action-val'));
        },
    }
}


$( document ).ready(function() {
    $('body').on('click','[data-cart-add]',function(){
        var id = $(this).attr('data-cart-add');
        var el = this;

        jet.cart.event.pre_add(this);

        $.ajax({
            url: "/cart/add",
            type: 'POST',
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id: id,
                '_token': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json'
        }).done(function(json) {
            jet.cart.event.add(el,json);
        }).error(function(){
            document.location.href = "/cart/add/"+id;
        });
        return false;
    })

    $('body').on('click','[data-cart-remove]',function(){
        var id = $(this).attr('data-cart-remove');
        var el = this;

        jet.cart.event.pre_remove(this);

        $.ajax({
            url: "/cart/remove",
            type: 'POST',
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id: id
            },
            dataType: 'json'
        }).done(function(json) {
            jet.cart.event.remove(el,json);
        }).error(function(){
            document.location.href = "/cart/remove/"+id;
        });
        return false;
    })

    $('body').on('click','[data-cart-clear]',function(){
        var id = $(this).attr('data-cart-clear');
        var el = this;

        jet.cart.event.pre_clear(this);

        $.ajax({
            url: "/cart/clear",
            type: 'POST',
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id: id
            },
            dataType: 'json'
        }).done(function(json) {
            jet.cart.event.clear(el,json);
        }).error(function(){
            document.location.href = "/cart/clear/"+id;
        });
        return false;
    })
});