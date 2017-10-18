@extends('layouts.app')

@section('content')
<div>
      <div>
        <h4>{{$description}}</h4>
        <a href = "{{route('criteratings')}}">Back</a>
      </div>
    </div>
@endsection