@foreach($list as $val)
        <!-- content -->
<div class="content">

    <table bgcolor="">
        <tr>
            <td class="small" width="20%" style="vertical-align: top; padding-right:10px;"><img src="{{asset(image_thumb_resize_canvas($val['image'],100))}}" /></td>
            <td>
                <h4>{{$val['title']}}</h4>
                <p>цена: <strong>{{$val['price']}}р</strong> количество: <strong>{{$item[$val['id']]}}шт</strong> общая
                        стоимость: <strong>{{$val['price']*$item[$val['id']]}}р</strong></p>
                <p class="">{{$val['description']}}</p>
                <a class="btn" href="{{asset($val['url'])}}">Перейти &raquo;</a>
            </td>
        </tr>
    </table>

</div><!-- /content -->
@endforeach