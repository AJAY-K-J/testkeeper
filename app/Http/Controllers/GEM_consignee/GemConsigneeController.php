<?php

namespace App\Http\Controllers\GEM_consignee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class GemConsigneeController extends Controller
{


    public function index()
    {
         if ( auth()->check() && Auth::user()->role == 'GeM-Consignee') {

        return view('Gem_consignee.gem_consignee');
         }else {
             return redirect('/');
         }
    }




    public function consigneeDetails()
    {



        $consignee_details = DB::table('stocks')
            ->join('sections', 'sections.id', '=', 'stocks.section_id')
            ->join('items', 'items.id', '=', 'stocks.item_id')
            ->join('suppliers', 'suppliers.id', '=', 'stocks.product_supplier_id')
            ->select([

                'stocks.product_id',
                'stocks.product_date',
                'stocks.quantity',
                'stocks.approvedquantity',


                'stocks.price',
                'stocks.invoice',

                'stocks.stock_type',
                'stocks.invoice_date',


                'stocks.Dc_no',
                'stocks.Dc_date',
                'stocks.arrivals_page_no',

               
                'stocks.remarks',
                'sections.name as section_name',
                'suppliers.name as supplier_name',
                'suppliers.gst',
                'suppliers.Details',
                'items.name as item_name',
                'items.category_name',
                'items.description_item',


            ])
            ->where([['stock_type', 'Gem-consignee'],['gemstatus', 0]])
            ->paginate(5);

        return $consignee_details;
    }


    public function GemArrivalBook(){
        if ( auth()->check() && Auth::user()->role == 'GeM-Consignee') {

        return view('Gem_consignee.gem_arrival_book');
    }else {
        return redirect('/');
    }


    }



    public function  GemArrivalDetails(){

        $GemArrival_details = DB::table('stocks')
        ->join('sections', 'sections.id', '=', 'stocks.section_id')
        ->join('items', 'items.id', '=', 'stocks.item_id')
        ->join('suppliers', 'suppliers.id', '=', 'stocks.product_supplier_id')
        ->select([

            'stocks.product_id',
            'stocks.product_date',
            'stocks.quantity',
            'stocks.approvedquantity',


            'stocks.price',
            'stocks.invoice',

            'stocks.stock_type',
            'stocks.invoice_date',
 'stocks.gemstatus',

            'stocks.Dc_no',
            'stocks.Dc_date',
            'stocks.arrivals_page_no',

           
            'stocks.remarks',
            'sections.name as section_name',
            'suppliers.name as supplier_name',
            'suppliers.gst',
            'suppliers.Details',
            'items.name as item_name',
            'items.category_name',
            'items.description_item',


        ])
        ->where([['stock_type', 'Gem-consignee']])
        ->paginate(5);

    return $GemArrival_details;

    }












}
