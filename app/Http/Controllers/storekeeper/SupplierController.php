<?php

namespace App\Http\Controllers\storekeeper;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Supplier;
class SupplierController extends Controller
{
    //

    public function index(){
        if(auth()->check() && auth()->user()->role=='Store-Keeper')
        {
        return view('storekeeper.addsupplier');
        }else{
            return redirect('/');
        }
    }

    public function supplierlist(){

        $supplier= Supplier::paginate(5);
        return $supplier;
        
    }


    public function store(Request $request)
    {

        $request->validate([

            'name'=>'Required',

            ]);

if($request->id){
    $Supplier=Supplier::find($request->id);
}else
    $Supplier = new Supplier;
  if($request->name){
      $Supplier->name=$request->name;
  }
  if($request->gst){
    $Supplier->gst=$request->gst;
}
if($request->Details){
    $Supplier->Details=$request->Details;
}


$Supplier->save();
return 'Success';     
        
    }





    public function destroy( $id)
    {
        $delete_supplier =Supplier::find($id);
        $delete_supplier->delete();
        return 'Success';
    }



}
