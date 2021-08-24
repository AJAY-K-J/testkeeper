<?php

namespace App\Http\Controllers\storekeeper;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Section;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->check() && auth()->user()->role=='Store-Keeper')
        {
        $role_details = Role::all();
        
        return view('storekeeper.adduser', compact('role_details'));
        }else{
            return redirect('/');
        }
    }

    public function userslist()
    {

        $users = User::all();
        return $users;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([

            'name' => 'Required',
            'username' => 'Required|unique:users,username',
            'email' => 'Required|unique:users,email',

            'role' => 'Required',



        ]);

        if ($request->id) {
            $user = User::find($request->id);
        } else
            $user = new User;
        if ($request->name) {
            $user->name = $request->name;
        }


        if ($request->username) {
            $user->username = $request->username;
        }
        if ($request->email) {
            $user->email = $request->email;
        }

        if ($request->role) {

            if ($request->role == 'section-in-charge') {
                $request->validate(
                    [
                        'section' => 'Required',

                    ]



                );

                

            }
 


            $user->role = $request->role;
        }
        if ($request->section) {

            $user->section = $request->section;
        }
        $user->save();
       
         if($request->section ==!null){
            $sec=Section::where('name', $request->section)->first();
            $sec->status=1;
            $sec->save();

         }

      
        return 'Success';
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete_user = User::find($id);
        $section =$delete_user->section;
        if($section !='null'){

            $sect=Section::where('name', $section)->first();
            $sect->status=0;
            $sect->save();

        }
        $delete_user->status=2;
        $delete_user->save();
        return 'Success';
    }
}
