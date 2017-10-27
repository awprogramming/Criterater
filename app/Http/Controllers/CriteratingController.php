<?php

namespace App\Http\Controllers;
use App\Criterating as Criterating;
use App\Criterion as Criterion;
use App\Rating as Rating;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CriteratingController extends Controller
{
    //

    public function __construct(Criterating $criterating )
    {
        $this->criterating = $criterating;
    }

    public function index(){
        $data = [];
        $data['mine'] = false;
        $data['criteratings'] = $this->criterating->all();
        return view('criterating/index',$data);
    }

    public function myCriteratings(){
        $data = [];
        $data['mine'] = true;
        $data['criteratings'] = $this->criterating->where('owner','=',Auth::user()->id)->get();
        return view('criterating/index',$data);
    }

    public function newCriterating(Request $request, Criterating $criterating)
    {
        $data = [];
        $data['description'] = $request->input('description');
        
        if($request->isMethod('post')){
            $this->validate(
                $request,
                [
                    'description' => 'required',
                ]
            );
            
            $criterating->insert($data);
            return redirect('criteratings');
        }
        $data['modify'] = 0;
        return view('criterating/form',$data);
    }

    public function show(Request $request,$criterating_id)
    {
        $criterating_data = $this->criterating->find($criterating_id);
        $criterating_data->owner == Auth::user()->id ? $data['mine'] = true : $data['mine'] = false;
        $data['show_mine'] = false;
        $data['criterating_id'] = $criterating_id;
        $data['description'] = $criterating_data->description;
        $criteria = [];
        $criteria = $criterating_data->criteria;
        $data['criteria'] = $criteria;
        
        $data['user_id'] = Auth::user()->id;
        $criterion_instance = new Criterion();

        $rating_instance = new Rating();
        $items = [];
        foreach($criterating_data->items as $item){
            $total = 0;
            $item_data = [];
            $item_data['item'] = $item;
            $item_data['criteria_scores'] = [];
            foreach($criteria as $criterion){
                $ratings = $rating_instance
                    ->where('item_id','=',$item->id)
                    ->where('criterion_id','=',$criterion->id)
                    ->get();
                if(count($ratings)!=0){
                    $criterion_total = 0;
                    foreach($ratings as $rating){
                        $criterion_total += $rating->score;
                    }
                    $weighted_criterion = $criterion_total * $criterion->weight;
                    $total+= $weighted_criterion / count($ratings);
                    $item_data['criteria_scores'][] = ($weighted_criterion / count($ratings))/10;
                }
            }
            $item_data['total'] = $total/10;
            $items[] = $item_data;
        }

        $items = collect($items);
        $items = $items->sortBy('total');
        $data['items'] = $items->reverse();
        return view('criterating/show',$data);
    }

    public function showMine(Request $request, $criterating_id, $user_id){
        $criterating_data = $this->criterating->find($criterating_id);
        $data['criterating_id'] = $criterating_id;
        $data['user_id'] = $user_id;
        $data['description'] = $criterating_data->description;
        $data['show_mine'] = true;
        $data['mine'] = false;
        $criteria = [];
        $criteria = $criterating_data->criteria;
        $items = $criterating_data->items;
        $data['criteria'] = $criteria;
        

        $criterion_instance = new Criterion();

        foreach($items as $i => $item){
            $total = 0;
            $my_ratings = $item->ratings->where('user_id','=',$user_id);
            foreach($my_ratings as $rating){
                $criterion = $rating->criterion;
                $total += ($criterion->weight) * ($rating->score);
            }
            $items[$i]['total'] = $total/10;
        }
        $items = collect($items);
        $items = $items->sortBy('total');
        $data['items'] = $items->reverse();

        return view('criterating/show',$data);
    }

    public function edit(Request $request,$criterating_id)
    {
        $data['modify'] = 1;
        $criterating_data = $this->criterating->find($criterating_id);
        $data['criterating_id'] = $criterating_id;
        $data['description'] = $criterating_data->description;

        return view('criterating/form',$data);
    }
    public function modify(Request $request,$criterating_id,Criterating $criterating)
    {
        $data = [];
        $data['description'] = $request->input('description');
        

        if($request->isMethod('post')){
            $this->validate(
                $request,
                [
                    'description' => 'required',
                ]
            );
            $criteratings_data = $this->criterating->find($criterating_id);

           $criteratings_data->description = $request->input('description');

           $criteratings_data->save();
            return redirect('criteratings');
        }
        $data['modify'] = 0;
        return view('criterating/form',$data);
    }

    public function delete(Request $request,$criterating_id)
    {
        $criterating_data = $this->criterating->find($criterating_id);
        $criterating_data->delete();
        return redirect('criteratings');
    }


}
