@extends('layouts.app')

@section('content')
<div>
      <div>
        @if($show_mine)
        <h4>My ratings for {{$description}}</h4>
        @else
        <h4>Average ratings for {{$description}}</h4>
        @endif
        @if(!$show_mine)
        @if($mine)
        <a href="{{route('edit_criteria',['criterating_id'=>$criterating_id])}}" class="btn btn-primary" role="button">Edit Criteria</a>
        <form action="{{route('delete_criterating',['criterating_id'=>$criterating_id])}}" method="POST">
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
            <button class="btn btn-primary">X</button>
        </form>
        <a href="{{route('new_item',['criterating_id'=>$criterating_id])}}" class="btn btn-primary" role="button">New Item</a>
        @endif
        <a href="{{route('show_my_criterating',['criterating_id'=>$criterating_id,'user_id'=>Auth::user()->id])}}" class="btn btn-primary" role="button">Rate</a>
        @endif
        <div>      
        </div>
        <table class="table">
          <thead>
            <tr>
            <th></th>
            @foreach($criteria as $criterion)
            <th>{{$criterion->description}} ({{$criterion->weight}}%)</th>
            @endforeach
            <th>Total</th>
            </tr>
          </thead>
          <tbody>
          @if($show_mine)
              @foreach($items as $item)
              <tr>
                <th>
                @if($show_mine)
                <a href="{{route('rate_item',['criterating_id'=>$criterating_id,'item_id'=>$item->id])}}">{{$item->description}}</a>
                @else
                <span>{{$item->description}}</span>
                @endif
                </th>
                @if(count($item->ratings->where('user_id','=',$user_id))==0)
                @foreach($criteria as $criterion)
                <td>0</td>
                @endforeach
                @else
                @foreach($item->ratings->where('user_id','=',$user_id) as $rating)
                <td>{{$rating->score * ($rating->criterion->weight)/10}}</td>
                @endforeach
                @endif
                <th>{{$item->total}}</th>
              </tr>
              @endforeach
          @else
          @foreach($items as $item)
              <tr>
                <th>
                <span>{{$item['item']->description}}</span>
                </th>
                @if(count($item['item']->ratings)==0)
                @foreach($criteria as $criterion)
                <td>0</td>
                @endforeach
                @else
                @foreach($item['criteria_scores'] as $score)
                <td>{{$score}}</td>
                @endforeach
                @endif
                <th>{{$item['total']}}</th>
              </tr>
              @endforeach
          @endif
          </tbody>
        </table>
        @if($show_mine)
        <a href = "{{route('show_criterating',['criterating_id'=>$criterating_id])}}">Back</a>
        @else
        <a href = "{{route('criteratings')}}">Back</a>
        @endif
      </div>
    </div>
@endsection