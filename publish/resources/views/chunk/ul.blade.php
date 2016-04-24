@if (isset($level[$index]))
    <ul>
    @foreach($level[$index] as $val)

        <li>
            <a @if($val->is_active)class="active"@endif href="{{$val->url}}">{{$val->label}}</a>
            @include('chunk.ul',['level'=>$level,'index'=>$val->id])
        </li>

    @endforeach
    </ul>
@endif