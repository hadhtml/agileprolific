@foreach($member as $r)
<div class="d-flex flex-row align-items-center justify-content-between single-member">
    <div class="d-flex flex-row align-items-center ">
        <div>
            @if($r->image != NULL)
            <img width="45px" height="45px" src="{{asset('public/assets/images/'.$r->image)}}" alt="Example Image">
            @else
            <img width="45px" height="45px" src="{{ Avatar::create($r->name.' '.$r->last_name)->toBase64() }}" alt="Example Image">
            @endif
            
        </div>
        <div class="d-flex flex-column ml-3">
            <p>{{$r->name}} {{ $r->last_name }}</p>
            <small>{{$r->email}}</small>
        </div>
    </div>
    <div>
        <input type="checkbox" value="{{$r->id}}" name="member[]">
    </div>
</div>
@endforeach