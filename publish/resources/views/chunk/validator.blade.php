@if(isset($validator))
<div class="errors">
    @foreach($validator->messages()->all() as $val)
        <div class="alert alert-danger">{{$val}}</div>
    @endforeach
</div>
@endif