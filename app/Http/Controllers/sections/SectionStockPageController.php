<?php

namespace App\Http\Controllers\sections;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Section;
use App\Models\Item;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SectionStockPageController extends Controller
{
    public function index(){

        if ( auth()->check() && Auth::user()->role == 'Section-Officer') {
$item_details=Item::all();


        return view('sections.section_store_book',compact('item_details'));
        }else{
            return redirect('/');
        }

    }



}
