@extends('layouts.app')

@section('content')
<div>
      <div>
        <h4>{{$modify == 1 ? 'Modify Item' : 'New Item'}}</h4>
        <form action="{{$modify == 1 ? route('update_item',['criterating_id'=>$criterating_id]) : route('create_item',['criterating_id'=>$criterating_id])}}" method="post">
          {{csrf_field()}}
          <div >
            <label>Description</label>
            <input name="description" type="text" value="{{old('description') ? old('description') : $description }}">
            <small class="error">{{$errors->first('description')}}</small>
          </div>
          <div>
            <input value="SAVE" class="btn btn-primary" type="submit">
          </div>
        </form>
      </div>
    </div>
@endsection