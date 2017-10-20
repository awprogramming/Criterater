<?php

namespace App\Http\Controllers;
use App\Criterating as Criterating;


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
        $data['criteratings'] = $this->criterating->all();
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
        $data['criterating_id'] = $criterating_id;
        $data['description'] = $criterating_data->description;
        $criteria = [];
        $criteria = $criterating_data->criteria;
        $data['criteria'] = $criteria;

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
