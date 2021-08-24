<?php

namespace App\Http\Controllers\storekeeper;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Category;

class ItemController extends Controller
{
    public function index(){

        if(auth()->check() && auth()->user()->role=='Store-Keeper')
        {

$category_details=Category::all();
        return view('storekeeper.additems',compact('category_details'));
        }else{
            return redirect('/');
        }
    }



    
    public function itemlist(){

        $item= Item::paginate(5);
        return $item;
        
    }


    public function store(Request $request)
    {

        $request->validate([

            'name'=>'Required',
            
            'category_name'=>'Required',
            'description_item' =>'Required',

            ]);

if($request->id){
    $item=Item::find($request->id);
}else
    $item = new Item;
  if($request->name){
      $item->name=$request->name;
  }
  if($request->category_name){
    $item->category_name=$request->category_name;
}
  if($request->description_item){
    $item->description_item=$request->description_item;
}


$item->save();
return 'Success';     
        
    }





    public function destroy( $id)
    {
        $delete_item =Item::find($id);
        $delete_item->status=1;
        $delete_item->save();
        return 'Success';
    }
}
