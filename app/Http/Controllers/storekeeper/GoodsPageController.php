<?php

namespace App\Http\Controllers\storekeeper;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SectionStock;
use App\Models\Stock;
use App\Models\Section;
use App\Models\Supplier;

use Illuminate\Support\Facades\DB;

class GoodsPageController extends Controller
{
    public function index()
    {
        if(auth()->check() && auth()->user()->role=='Store-Keeper')
        {
        $section_details = Section::all()->where('status', '=', '1');
        $supplier_details = Supplier::all();

        return view('storekeeper.girbook', compact('section_details', 'supplier_details'));
        }else{
            return redirect('/');
        }
    }
    public function goodslist( Request $request)
    {


        $goods_details = DB::table('stocks')
            ->join('sections', 'sections.id', '=', 'stocks.section_id')

            ->join('items', 'items.id', '=', 'stocks.item_id')

            ->join('suppliers', 'suppliers.id', '=', 'stocks.product_supplier_id')
            ->select([


                'suppliers.name as supplier_name',
                'suppliers.gst',
                'suppliers.Details',
                'stocks.price',
                'stocks.invoice',
                'stocks.Dc_no',
                'stocks.quantity',
                'stocks.approvedquantity',
                'stocks.balance_quantity',
                'stocks.product_date',
                'stocks.product_id',
                'stocks.item_id',

                'stocks.purchase_order_no',
                'stocks.purchase_order_date',
                'stocks.category_book',

                'stocks.category_book_page_no',
                'stocks.gir_page_no',
                'stocks.arrivals_page_no',
                'items.name as item_name',
                'items.description_item',


            ]);
            if ($request->date_from)
           $goods_details->whereDate('product_date', '>=', $request->date_from);


        if ($request->date_to)
           $goods_details->whereDate('product_date', '<=', $request->date_to);




        if ($request->supplier)
           $goods_details->where('product_supplier_id', '=', $request->supplier);


        if ($request->entry)
           $goods_details->where('stock_type', $request->entry);

        if ($request->section)
           $goods_details->where('section_id', $request->section);


        $return =  $goods_details->paginate(5);


        return    $return;

        
    }


    public function sectionName()
    {

        $section = Section::all();
        return $section;
    }




    public function allot(Request $request)
    {


        $request->validate([

            'section_name' => 'Required',
            'quantity' => 'Required|integer|min:1',

        ]);


        


        if($request->product_id && $request->quantity){

            $stockCheck = Stock::where('product_id', $request->product_id)->first();

            if($request->quantity >  $stockCheck->balance_quantity){
                return 'excessQuantity';
            }

        }





        $store = SectionStock::where([['product_id', $request->product_id], ['item_id', $request->item_id], ['section_name', $request->section_name]])->first();

        if ($store) {

         
            $store->quantity = $store->quantity + $request->quantity;
            $store->quantity_stock = $store->quantity_stock + $request->quantity;
        } else {

            $store = new SectionStock;

            if ($request->product_id) {
                $store->product_id = $request->product_id;


            }

            if ($request->item_id) {
                $store->item_id = $request->item_id;
            }


            if ($request->quantity) {
                $store->quantity = $request->quantity;
            }


            if ($request->quantity) {
                $store->quantity_stock = $request->quantity;
            }


            if ($request->section_name) {
                $store->section_name = $request->section_name;
            }
        }
        if ($store->save()) {

            $stock = Stock::where('product_id', $request->product_id)->first();

            $stock->balance_quantity = $stock->balance_quantity - $request->quantity;

            $stock->save();
            return 'Success';
        }


        

    }


public function exportGirList(Request $request){


    


    $goods_details = DB::table('stocks')
    ->join('sections', 'sections.id', '=', 'stocks.section_id')

    ->join('items', 'items.id', '=', 'stocks.item_id')

    ->join('suppliers', 'suppliers.id', '=', 'stocks.product_supplier_id')
    ->select([


        'suppliers.name as supplier_name',
        'suppliers.gst',
        'suppliers.Details',
        'stocks.price',
        'stocks.invoice',
        'stocks.Dc_no',
        'stocks.quantity',
        'stocks.approvedquantity',
        'stocks.balance_quantity',
        'stocks.product_date',
        'stocks.product_id',
        'stocks.item_id',

        'stocks.purchase_order_no',
        'stocks.purchase_order_date',
        'stocks.category_book',

        'stocks.category_book_page_no',
        'stocks.gir_page_no',
        'stocks.arrivals_page_no',
        'items.name as item_name',
        'items.description_item',


    ]);
    if ($request->date_from)
   $goods_details->whereDate('product_date', '>=', $request->date_from);


if ($request->date_to)
   $goods_details->whereDate('product_date', '<=', $request->date_to);




if ($request->supplier)
   $goods_details->where('product_supplier_id', '=', $request->supplier);


if ($request->entry)
   $goods_details->where('stock_type', $request->entry);

if ($request->section)
   $goods_details->where('section_id', $request->section);


$return =  $goods_details->get();


return    $return;

}





}
