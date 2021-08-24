<?php

namespace App\Http\Controllers\sections;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DeprecatedStock;
use App\Models\Stock;
use App\Models\SectionStock;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

class DeprecatedStockController extends Controller
{


    public function store(Request $request)
    {


        $request->validate([


            'Depreciated_Quantity' => 'Required|integer|min:1',

        ]);




        if ($request->productId && $request->Depreciated_Quantity) {

            $tockCheck = SectionStock::where('product_id', $request->productId)->first();

            if ($request->Depreciated_Quantity > $tockCheck->quantity_stock) {

                return 'excessStock';
            }
        }













        $store = DeprecatedStock::where([['product_id', $request->productId], ['item_id', $request->item_id], ['section_name', $request->section_name]])->first();

        if ($store) {



            $store->deprecated_quantity = $store->deprecated_quantity + $request->Depreciated_Quantity;
        } else {

            $store = new DeprecatedStock;

            if ($request->productId) {
                $store->product_id = $request->productId;
            }

            if ($request->item_id) {
                $store->item_id = $request->item_id;
            }


            if ($request->Depreciated_Quantity) {
                $store->deprecated_quantity = $request->Depreciated_Quantity;
            }





            if ($request->section_name) {
                $store->section_name = $request->section_name;
            }
        }
        if ($store->save()) {


            $stock = Stock::where('product_id', $request->productId)->first();

            $stock->deprecated_quantity = $stock->deprecated_quantity + $request->Depreciated_Quantity;

            if ($stock->save()) {


                $section_stock = SectionStock::where('product_id', $request->productId)->first();

                $section_stock->quantity_stock = $section_stock->quantity_stock - $request->Depreciated_Quantity;

                $section_stock->save();
                return 'Success';
            }
        }
    }


    public function depreciatedStock()
    {

        if (Auth::user()->role == 'Section-Officer') {




            $data = DB::table('deprecated_stocks')
                ->join('storearrivals', 'storearrivals.id', '=', 'deprecated_stocks.product_id')
                ->join('items', 'items.id', '=', 'deprecated_stocks.item_id')
                ->select([



                    'deprecated_stocks.product_id',
                    'deprecated_stocks.item_id',
                    'deprecated_stocks.section_name',
                    'deprecated_stocks.deprecated_quantity',
                    'items.name as item_name',
                    'items.description_item',
                ])
                ->where('section_name', '=', Auth::user()->section)
                ->paginate(5);

            return   $data;
        }
    }
}
