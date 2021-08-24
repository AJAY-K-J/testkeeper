<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

use App\Models\Section;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register()
    {

        return view('auth.register');
    }


  















    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'role' => 'Required',

            // 'password' => 'required|string|min:8|confirmed',
            // 'password_confirmation' => 'required',
        ]);

        // User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),
        // ]);

        // return redirect('home');
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
        $user->password = Hash::make('adit2019');

        if ($request->role) {

            if ($request->role == 'Section-Officer') {
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


        

        if ($request->firstUser) {


            $store_keeper = new Role;
            $store_keeper->name = 'Store-Keeper';
            $store_keeper->status = 1;
            $store_keeper->save();


            $section_officer = new Role;
            $section_officer->name = "Section-Officer";

            $section_officer->save();

            $store_officer = new Role;
            $store_officer->name = "Store-Officer";

            $store_officer->save();

            $gem_consignee = new Role;
            $gem_consignee->name = "GeM-Consignee";

            $gem_consignee->save();

            $head_ofiice = new Role;
            $head_ofiice->name = "SAS";

            $head_ofiice->save();

            $user->save();
            return 'success';
        }






        $user->save();

        if ($request->section == !null) {
            $sec = Section::where('name', $request->section)->first();
            $sec->status = 1;
            $sec->save();
        }
if($user->save()){

    $userRole=Role::where('name', $request->role)->first();
    $userRole->status=1;
    $userRole->save();
}

        return 'Success';
    }
}
