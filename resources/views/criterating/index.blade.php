@extends('layouts.app')

@section('content')
<div>
      <div>
        <h4>Criteratings</h4>
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
                  <a href="{{route('edit_criterating',['criterating_id'=>$criterating->id])}}" class="btn btn-primary" role="button">Edit</a>
                </td>
              </tr>
              @endforeach
          </tbody>
        </table>
      </div>
    </div>
@endsection