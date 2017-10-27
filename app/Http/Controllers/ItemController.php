<?php

namespace App\Http\Controllers;
use App\Item as Item;
use App\Criterating as Criterating;
use App\Rating as Rating;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    //
    public function __construct(Criterating $item )
    {
        $this->item = $item;
    }

    public function newItem(Request $request,$criterating_id, Item $item)
    {
        $data = [];
        $data['criterating_id'] = $criterating_id;


        $data['description'] = $request->input('description');
        if($request->isMethod('post')){
            $this->validate(
                $request,
                [
                    'description' => 'required',
                ]
            );
            $new_item_id = $item->insertGetId($data);
            
            $criterating_instance = new Criterating();
            // $rating_instance = new Rating();
    
            $criterating = $criterating_instance->find($criterating_id);
    
            $criteria = $criterating->criteria;
            $rating_data = [];
            $rating_data['item_id'] = $new_item_id;
            $rating_data['score'] = 0;
            // foreach($criteria as $criterion){
            //     $rating_data['criterion_id'] = $criterion->id;
            //     $new_rating = $rating_instance->insert($rating_data);
            // }

            return redirect()->route('show_criterating',['criterating_id'=>$criterating_id]);
        }
        else{
        $data['modify'] = 0;
        return view('item/form',$data);
        }
    }
    public function edit(Request $request,$item_id)
    {
        $data['modify'] = 1;
        $item_data = $this->item->find($item_id);
        $data['item_id'] = $item_id;
        $data['description'] = $item_data->description;

        return view('item/form',$data);
    }
    public function modify(Request $request,$item_id,Item $item)
    {
        $data = [];
        $data['description'] = $request->input('description');
        

        if($request->isMethod('post')){
            $this->validate(
                $request,
                [
                    'description' => 'description',
                ]
            );
            $item_data = $this->item->find($item_id);

            $item_data->description = $request->input('item');

            $item_data->save();
            return redirect('criteratings');
        }
        $data['modify'] = 0;
        return view('item/form',$data);
    }

    public function rate(Request $request,$criterating_id, $item_id){
        
        $item_instance = new Item();
        $item = $item_instance->find($item_id);

        $rating_instance = new Rating();

        $user_id = Auth::user()->id;

        if($request->isMethod('post')){   
            $new_rating_data = $request->input('ratings');

            foreach($new_rating_data as $id => $score){
                
                var_dump($score);
                
                $rating = $rating_instance->find($id);
                $rating->score = $score;
                $rating->save();
            }
            return redirect()->route('show_my_criterating',['criterating_id'=>$criterating_id,'user_id'=>$user_id]);
        }
        $data['criterating_id'] = $criterating_id;
        $data['item'] = $item;
        if(count($item->ratings->where('user_id','=',$user_id))==0){
            $criteria = $item->criterating->criteria;
            $rating_data['item_id'] = $item->id;
            $rating_data['score'] = 0;
            foreach($criteria as $criterion){
                $rating_data['criterion_id'] = $criterion->id;
                $rating_data['user_id'] = $user_id;
                $new_rating_id = $rating_instance->insertGetId($rating_data);
                $data['ratings'][] = $rating_instance->find($new_rating_id);
            }
        }
        else
            $data['ratings'] = $item->ratings->where('user_id','=',$user_id);
        return view('item/rate',$data);
    }
}
