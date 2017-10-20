<?php

namespace App\Http\Controllers;
use App\Criterating as Criterating;
use App\Criterion as Criterion;

use Illuminate\Http\Request;

class CriterionController extends Controller
{
    //

    public function __construct(Criterion $criterion)
    {
        $this->criterion = $criterion;
    }

    public function edit(Request $request,$criterating_id)
    {
        $criterating_instance = new Criterating();
        $criterating_data = $criterating_instance->find($criterating_id);
        $data['criterating_id'] = $criterating_id;
        $data['description'] = $criterating_data->description;
        $criteria = [];
        $criteria = $criterating_data->criteria;
        $data['criteria'] = $criteria;

        return view('criterion/edit',$data);
    }

    public function modify(Request $request,$criterating_id){

        if($request->has('criteria')){
            foreach($request->input('criteria') as $id => $criterion){
                $criterion_data = $this->criterion->find($id);
                $criterion_data->description = $criterion['desc'];
                $criterion_data->weight = $criterion['weight'];

                $criterion_data->save();
            }
        }
        if($request->has('newCriteria')){
            foreach($request->input('newCriteria') as $criterion){
                
                $data = [];
                $data['criterating_id'] = $criterating_id;
                $data['description'] = $criterion['desc'];
                $data['weight'] = $criterion['weight'];
                $this->criterion->insert($data);
            }
        }
        return redirect()->route('show_criterating',['criterating_id'=>$criterating_id]);
    }

    public function delete(Request $request,$criterating_id,$criterion_id)
    {
        $criterion_data = $this->criterion->find($criterion_id);
        $criterion_data->delete();
        //return redirect()->route('edit_criterating',['criterating_id'=>$criterating_id]);
    }

}
