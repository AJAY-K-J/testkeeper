<?php

namespace App\Http\Controllers\storekeeper;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        if (auth()->check() && auth()->user()->role == 'Store-Keeper') {
            return view('storekeeper.addcategories');
        } else {
            return redirect('/');
        }
    }



    public function categorylist()
    {

        $category = Category::all();
        return $category;
    }


    public function store(Request $request)
    {

        $request->validate([

            'name' => 'Required',

        ]);

        if ($request->id) {
            $Category = Category::find($request->id);
        } else
            $Category = new Category;
        if ($request->name) {
            $Category->name = $request->name;
        }


        $Category->save();
        return 'Success';
    }





    public function destroy($id)
    {
        $delete_category = Category::find($id);
        $delete_category->delete();
        return 'Success';
    }
}
