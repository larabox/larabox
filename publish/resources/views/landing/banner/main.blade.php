<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        @if(isset($block['img_image_1']) and  $block['img_image_1'])
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
        @endif

        @if(isset($block['img_image_2']) and  $block['img_image_2'])
             <li data-target="#carousel-example-generic" data-slide-to="1" class="active"></li>
        @endif

        @if(isset($block['img_image_3']) and  $block['img_image_3'])
             <li data-target="#carousel-example-generic" data-slide-to="2" class="active"></li>
        @endif

        @if(isset($block['img_image_4']) and  $block['img_image_4'])
            <li data-target="#carousel-example-generic" data-slide-to="3" class="active"></li>
        @endif

        @if(isset($block['img_image_5']) and  $block['img_image_5'])
            <li data-target="#carousel-example-generic" data-slide-to="4" class="active"></li>
        @endif
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">

        @if(isset($block['img_image_1']) and  $block['img_image_1'])
        <div class="item active">
            <img src="/{{$block['img_image_1']}}" alt="{{$block['img_label_1']}}">
            <div class="carousel-caption">
                ...
            </div>
        </div>
        @endif

        @if(isset($block['img_image_2']) and  $block['img_image_2'])
            <div class="item">
                <img src="/{{$block['img_image_2']}}" alt="{{$block['img_label_2']}}">
                <div class="carousel-caption">
                    ...
                </div>
            </div>
        @endif

        @if(isset($block['img_image_3']) and  $block['img_image_3'])
            <div class="item">
                <img src="/{{$block['img_image_3']}}" alt="{{$block['img_label_3']}}">
                <div class="carousel-caption">
                    ...
                </div>
            </div>
        @endif

        @if(isset($block['img_image_4']) and  $block['img_image_4'])
            <div class="item">
                <img src="/{{$block['img_image_4']}}" alt="{{$block['img_label_4']}}">

                <div class="carousel-caption">
                    ...
                </div>
            </div>
        @endif

        @if(isset($block['img_image_5']) and  $block['img_image_5'])
            <div class="item">
                <img src="/{{$block['img_image_5']}}" alt="{{$block['img_label_5']}}">
                <div class="carousel-caption">
                    ...
                </div>
            </div>
        @endif
    </div>

    <!-- Controls -->
    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>