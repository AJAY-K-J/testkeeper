<?php

namespace App\Http\Controllers\storekeeper;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Stock;
use App\Models\Storearrival;
use Illuminate\Support\Facades\DB;

class ConfirmedItemsController extends Controller
{
    public function index()
    {
        if(auth()->check() && auth()->user()->role=='Store-Keeper')
        {

        return view('storekeeper.confirmed_items');
        }else{
            return redirect('/');
        }
    }

    public function confirmedItems()
    {



        $result = DB::table('storearrivals')
            ->join('sections', 'sections.id', '=', 'storearrivals.section')
            ->join('items', 'items.id', '=', 'storearrivals.item_name')
            ->join('suppliers', 'suppliers.id', '=', 'storearrivals.supplier')
            ->select([

                'storearrivals.id',
                'storearrivals.date',
                'storearrivals.supplier',
                'storearrivals.quantity',
                'storearrivals.approvedquantity',
                'storearrivals.price',
                'storearrivals.invoice',
                'storearrivals.invoice_date',
                'storearrivals.stock_type',
                'storearrivals.Dc_no',
                'storearrivals.Dc_date',
                'storearrivals.arrivals_page_no',
                'storearrivals.sign_of_insp_officer',
                'storearrivals.store_officer',
                'storearrivals.remarks',
                'sections.id as section_id',
                'sections.name as section_name',
                'suppliers.id as supplier_id',
                'suppliers.name as supplier_name',
                'suppliers.gst',
                'suppliers.Details',
                'items.id as item_id',
                'items.name as item_name',
                'items.category_name',
                'items.description_item',


            ])
            ->where([['sign_of_ask', 1],['store_officer', 1], ['sign_of_insp_officer', 1]])
            ->paginate(5);


        return    $result;
    }





    public function store(Request $request)
    {

        $request->validate([

            'category_book_page_no' => 'Required',
            'purchase_order_no' => 'Required',
            'purchase_order_date' => 'Required',
            'category_book' => 'Required',



        ]);

        // if ($request->product_id) {
        //     $store = Stock::find($request->product_id);
        // } else
            $store = new Stock;
        if ($request->product_id) {
            $store->product_id = $request->product_id;
        }

        if ($request->product_date) {
            $store->product_date = $request->product_date;
        }


        if ($request->product_supplier_id) {
            $store->product_supplier_id = $request->product_supplier_id;
        }



        if ($request->section_id) {
            $store->section_id = $request->section_id;
        }

        if ($request->item_id) {
            $store->item_id = $request->item_id;
        }

        if ($request->quantity) {
            $store->quantity = $request->quantity;

        }

        if ($request->approvedquantity) {
            $store->approvedquantity = $request->approvedquantity;

        }


        if ($request->approvedquantity) {
            $store->balance_quantity = $request->approvedquantity;
        }
        if ($request->price) {
            $store->price = $request->price;
        }
        if ($request->invoice) {
            $store->invoice = $request->invoice;
        }
        if ($request->Dc_no) {
            $store->Dc_no = $request->Dc_no;
        }

        if ($request->Dc_date) {
            $store->Dc_date = $request->Dc_date;
        }


if ($request->stock_type) {
            $store->stock_type = $request->stock_type;
        }

if ($request->invoice_date) {
            $store->invoice_date = $request->invoice_date;
        }


        if ($request->arrivals_page_no) {
            $store->arrivals_page_no = $request->arrivals_page_no;
        }

        if ($request->gir_page_no) {
            $store->gir_page_no = $request->gir_page_no;
        }
        if ($request->category_book) {
            $store->category_book = $request->category_book;
        }

        if ($request->category_book_page_no) {
            $store->category_book_page_no = $request->category_book_page_no;
        }
        if ($request->purchase_order_no) {
            $store->purchase_order_no = $request->purchase_order_no;
        }
        if ($request->purchase_order_date) {
            $store->purchase_order_date = $request->purchase_order_date;
        }
        if ($request->remarks) {
            $store->remarks = $request->remarks;
        }



      $store->save();
        $ask=Storearrival::find($request->product_id);
        $ask->sign_of_ask=2;
        $ask->save();
        return 'Success';

   
    }




}

