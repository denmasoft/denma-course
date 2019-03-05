@foreach($specialties as $specialty)
    <option value="{{$specialty->ID}}">{{$specialty->description}}</option>
@endforeach