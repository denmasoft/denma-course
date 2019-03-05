@foreach($concellos as $concello)
    <option value="{{$concello->id}}">{{$concello->name}}</option>
@endforeach