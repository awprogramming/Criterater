@extends('layouts.app')

@section('content')
<div>
    <h1>Rating for {{$item->description}}</h1>

    @foreach($ratings as $rating)
    <div>
    <h2>{{$rating->criterion->description}} ({{$rating->criterion->weight}}%)</h2>
    <form action="{{route('save_ratings',['criterating_id'=>$criterating_id,'item_id'=>$item->id])}}" method="post">
    {{csrf_field()}}
    <table class="table">
        <tr>
            <td><input class="rating" type="range" min='0' max='10' value="{{$rating->score}}" name="ratings[{{$rating->id}}]"></td>
            <td><span class="score" data-weight="{{$rating->criterion->weight}}">{{$rating->score}}</span></td>
        </tr>
        </table>
    </div>
    @endforeach
    <div>
    <h2>Total</h2>
    <span id="total"></span>
    <input type="submit">
    </form>
    </div>
</div>
<script>
    $(function(){
        $('.rating').change(function(){
            $(this).parent().next().find(".score").html($(this).val());
            calculateTotal();
        });

        var calculateTotal = function(){
            var total = 0;
            $('.score').each(function(){
                total += $(this).data('weight') * $(this).html()
            });
            total = total / 10;
            $('#total').html(total);

        }

        calculateTotal();

        
    });
    
</script>
@endsection