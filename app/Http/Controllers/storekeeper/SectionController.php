<?php

namespace App\Http\Controllers\storekeeper;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Section;

class SectionController extends Controller
{
    public function index(){

        if(auth()->check() && auth()->user()->role=='Store-Keeper')
        {
        return view('storekeeper.addsections');
        }else{
            return redirect('/');
        }
    }

    public function sectionslist(){

        $section= Section::all();
        return $section;
        
    }

    public function sectiondata(){

        $section_details = Section::all()->where('status', 0);
        return $section_details;

    }

    public function store(Request $request)
    {

        $request->validate([

            'name'=>'Required|unique:sections',

            ]);

if($request->id){
    $Section=Section::find($request->id);
}else
    $Section = new Section;
  if($request->name){
      $Section->name=$request->name;
  }


$Section->save();
return 'Success';     
        
    }





    public function destroy( $id)
    {
        $delete_section = Section::find($id);
        $delete_section->delete();
        return 'Success';
    }


}
