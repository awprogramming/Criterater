@extends('layouts.app')

@section('content')
<div>
      <div>
        <h4>{{$description}}</h4>
        <a href="{{route('edit_criteria',['criterating_id'=>$criterating_id])}}" class="btn btn-primary" role="button">Edit Criteria</a>
        <form action="{{route('delete_criterating',['criterating_id'=>$criterating_id])}}" method="POST">
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
            <button class="btn btn-primary">Delete User</button>
        </form>
        <div>
        @foreach($criteria as $criterion)
        <span>{{$criterion->description}} </span>
        @endforeach
        </div>
        <a href = "{{route('criteratings')}}">Back</a>
      </div>
    </div>
@endsection