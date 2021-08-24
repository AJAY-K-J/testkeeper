<?php

namespace App\Http\Controllers\sections;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

use Illuminate\Support\Facades\DB;

class SectionStockController extends Controller
{
  public function sectionStock(Request $request)
  {



    if (Session()->has('Section-Officer')) {

      $user_id = Session('Section-Officer');
      $user_detail = User::where('id', '=',  $user_id)->pluck('section');


      $data = DB::table('section_stocks')
        ->join('storearrivals', 'storearrivals.id', '=', 'section_stocks.product_id')
        ->join('items', 'items.id', '=', 'section_stocks.item_id')
        ->select([



          'section_stocks.product_id',
          'section_stocks.item_id',
          'section_stocks.section_name',
          'section_stocks.quantity',
          'section_stocks.quantity_stock',
          'items.name as item_name',
          'items.description_item',
        ])
        ->where('section_name', '=', $user_detail);



      if ($request->date_from)
        $data->whereDate('product_date', '>=', $request->date_from);


      if ($request->date_to)
        $data->whereDate('product_date', '<=', $request->date_to);




      if ($request->item_name)
        $data->where('item_id', '=', $request->item_name);




      return   $data->paginate(5);
    }
  }


  public function exportSectionStock(Request $request)
  {


    $user_id = Session('Section-Officer');
    $user_detail = User::where('id', '=',  $user_id)->pluck('section');


    $data = DB::table('section_stocks')
      ->join('storearrivals', 'storearrivals.id', '=', 'section_stocks.product_id')
      ->join('items', 'items.id', '=', 'section_stocks.item_id')
      ->select([



        'section_stocks.product_id',
        'section_stocks.item_id',
        'section_stocks.section_name',
        'section_stocks.quantity',
        'section_stocks.quantity_stock',
        'items.name as item_name',
        'items.description_item',
      ])
      ->where('section_name', '=', $user_detail);



    if ($request->date_from)
      $data->whereDate('product_date', '>=', $request->date_from);


    if ($request->date_to)
      $data->whereDate('product_date', '<=', $request->date_to);




    if ($request->item_name)
      $data->where('item_id', '=', $request->item_name);




    return   $data->get();
  }
}
