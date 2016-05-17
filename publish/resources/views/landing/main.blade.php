{{--
    $align = расположение right|center|left
    $title = загаловок обезателен к заполненияю
    $subtitle = под загаловок можно не указывать
    $background = Фон можно не указывать
--}}

<div id="id-{{$id}}"  class="{{$block['class'] or ''}} landing-block-title text-{{$align or 'center'}}">
    <div class="container">
        <div class="inner">
            <p class="h1">{{$title or 'title'}}</p>
            @if(isset($subtitle) and $subtitle)
                <p class="h3">{{$subtitle}}</p>
            @endif
        </div>
    </dib>
</div>

<style>
    #id-{{$id}} {
        background: url('{{$background or '' }}');
        background-position: top center;
        background-repeat: no-repeat;
        min-height: {{$min_height_block or '346'}}px;
    }

    #id-{{$id}} .inner{
        margin: auto;
        max-width: {{$width_inner or '700px' }};
    }
    #id-{{$id}} .h1{
        color: {{$color_h1 or '#333333'}};
    }

    #id-{{$id}} .h3{
        color: {{$color_h3 or '#333333'}};
    }

</style>


{{App\Landing::addStyle('/css/landing/title.css')}}
