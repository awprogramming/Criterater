@extends('layouts.app')

@section('content')
<div>
      <div>
        <h4>Edit Criteria</h4>
        <form action="{{route('update_criteria',['criterating_id'=>$criterating_id])}}" method="post" onsubmit="return checkTotal()">
          {{csrf_field()}}
          <table class="table" id="criteria_table">
          <thead>
            <tr>
              <th>Description</th>
              <th>Weight</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
          @foreach($criteria as $criterion)
            <tr>
                <td><input type="text" name="criteria[{{$criterion->id}}][desc]" value="{{$criterion->description}}"></td>
                <td><input type="text" name="criteria[{{$criterion->id}}][weight]" class="weight" value="{{$criterion->weight}}"></td>
                <td> <button class="btn btn-primary delete_button" data-criterionid="{{$criterion->id}}">X</button></td>
            </tr>
          @endforeach
          </tbody>
          </table>
          <div>
            <input value="Save" class="btn btn-primary" type="submit">
          </div>
        </form>
        <button class="btn btn-primary" id="add">+</button>
        <a href = "{{route('show_criterating',['criterating_id'=>$criterating_id])}}">Back</a>
      </div>
</div>
<script>
    
    $(function(){
        var tempId = 0;
        $('#add').click(function(){
            $('#criteria_table').append("<tr><td><input name='newCriteria["+tempId+"][desc]' type='text'></td><td><input name='newCriteria["+tempId+"][weight]' class='weight' type='text'></td></tr>");
            tempId++;
        });

        $('.delete_button').click(function(evt){
        evt.preventDefault();
        var ajax = $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/criteratings/{{$criterating_id}}/criteria/delete/"+$(this).data('criterionid'),
                type: "DELETE"
            });
        $(this).parent().parent().remove();
        });

    });
    var checkTotal = function(){
        var total = 0;
        $('.weight').each(function(){
            total += parseInt($(this).val());
        });
        if(total==100)
            return true;
        else{
            alert("Weights must total to 100 "+total);
            return false;
        }
    }

    
</script>
@endsection