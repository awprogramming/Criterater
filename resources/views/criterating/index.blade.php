@extends('layouts.app')

@section('content')
<div>
      <div>
        <h4>{{$mine ? "My" : "All"}} Criteratings</h4>
        @if(!$mine)
        <a href="{{ route('my_criteratings',['user_id'=>Auth::user()->id]) }}">My Criteratings</a>
        @endif
        <a href="{{ route('new_criterating') }}" class="btn btn-primary" role="button">New Criterating</a>        
        <table class="table">
          <thead>
            <tr>
              <th>Description</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
              @foreach($criteratings as $criterating)
              <tr>
                <td>{{$criterating->description}}</td>
                <td>
                <a href="{{route('show_criterating',['criterating_id'=>$criterating->id])}}" class="btn btn-primary" role="button">View</a>
                @if($criterating->owner == Auth::user()->id)
                <form action="{{route('edit_criterating',['criterating_id'=>$criterating->id])}}" method="POST">
                    {{ method_field('PUT') }}
                    {{ csrf_field() }}
                    <button class="btn btn-primary">Edit</button>
                </form>
                @endif
                </td>
              </tr>
              @endforeach
          </tbody>
        </table>
      </div>
    </div>
@endsection