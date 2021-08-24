<?php

namespace App\Http\Controllers\storekeeper;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;

class RoleController extends Controller
{
    public function index(){

        if(auth()->check() && auth()->user()->role=='Store-Keeper')
        {
        return view('storekeeper.addroles');
        }else{
            return redirect('/');
        }
    }


    public function roleslist(){

        $role= Role::all();
        return $role;
        
    }


    public function store(Request $request)
    {

      
   


if($request->store_keeper){

    $store_keeper=new Role;
    $store_keeper->name=$request->store_keeper;

$store_keeper->save();
}




if($request->section_officer){

    $section_officer=new Role;
    $section_officer->name=$request->section_officer;

$section_officer->save();
}



if($request->store_officer){

    $store_officer=new Role;
    $store_officer->name=$request->store_officer;

$store_officer->save();
}


if($request->gem_consignee){

    $gem_consignee=new Role;
    $gem_consignee->name=$request->gem_consignee;

$gem_consignee->save();
}




if($request->head_ofiice){

    $head_ofiice=new Role;
    $head_ofiice->name=$request->head_ofiice;

$head_ofiice->save();
}



return 'success';





        
    }





    // public function destroy( $id)
    // {
    //     $delete_role = Role::find($id);
    //     $delete_role->delete();
    //     return 'Success';
    // }


    



}
