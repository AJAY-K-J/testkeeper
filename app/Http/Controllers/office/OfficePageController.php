<?php

namespace App\Http\Controllers\office;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Section;
use App\Models\Supplier;
use App\Models\Item;
use Carbon\Carbon;


class OfficePageController extends Controller
{
   public function index()
   {
      if (auth()->check() && Auth::user()->role == 'SAS') {


         $section_details = Section::all()->where('status', '=', '1');
         $supplier_details = Supplier::all();

         return view('office.officedashboard', compact('section_details', 'supplier_details'));
      } else {
         return redirect('/');
      }
   }


   public function officeArrival()
   {
      if (auth()->check() && Auth::user()->role == 'SAS') {
         $section_details = Section::all()->where('status', '=', '1');
         $supplier_details = Supplier::all();
         return view('office.officeArrival', compact('section_details', 'supplier_details'));
      } else {
         return redirect('/');
      }
   }
   public function officeGir()
   {
      if (auth()->check() && Auth::user()->role == 'SAS') {
         $section_details = Section::all()->where('status', '=', '1');
         $item_details = Item::all();


         return view('office.officeGIR', compact('section_details', 'item_details'));
      } else {
         return redirect('/');
      }
   }
   public function officeKardex()
   {
      if (auth()->check() && Auth::user()->role == 'SAS') {
         $section_details = Section::all()->where('status', '=', '1');
         $item_details = Item::all();
         return view('office.officeKardex', compact('section_details', 'item_details'));
      } else {
         return redirect('/');
      }
   }
   public function officeDsr()
   {
      if (auth()->check() && Auth::user()->role == 'SAS') {
         $section_details = Section::all()->where('status', '=', '1');
         $item_details = Item::all();

         return view('office.officeDSR', compact('section_details', 'item_details'));
      } else {
         return redirect('/');
      }
   }
   public function officeRejectedPage()
   {
      if (auth()->check() && Auth::user()->role == 'SAS') {
         $section_details = Section::all()->where('status', '=', '1');
         $supplier_details = Supplier::all();

         return view('office.officeRejection', compact('section_details', 'supplier_details'));
      } else {
         return redirect('/');
      }
   }
   public function officeGemConsignee()
   {
      if (auth()->check() && Auth::user()->role == 'SAS') {
         $section_details = Section::all()->where('status', '=', '1');
         $supplier_details = Supplier::all();

         return view('office.officeGemConsignee', compact('section_details', 'supplier_details'));
      } else {
         return redirect('/');
      }
   }


   public function officeArrivaldata(Request $request)
   {

      $section_details = DB::table('storearrivals')
         ->join('sections', 'sections.id', '=', 'storearrivals.section')
         ->join('items', 'items.id', '=', 'storearrivals.item_name')
         ->join('suppliers', 'suppliers.id', '=', 'storearrivals.supplier')



         ->select([

            'storearrivals.id',
            'storearrivals.date',
            'storearrivals.supplier',
            'storearrivals.quantity',
            'storearrivals.approvedquantity',
            'storearrivals.rejectedquantity',
            'storearrivals.stock_type',
            'storearrivals.price',
            'storearrivals.invoice',
            'storearrivals.invoice_date',
            'storearrivals.Dc_no',
            'storearrivals.Dc_date',
            'storearrivals.arrivals_page_no',
            'storearrivals.sign_of_insp_officer',
            'storearrivals.store_officer',
            'storearrivals.gem_officer',

            'storearrivals.remarks',
            'sections.name as section_name',
            'suppliers.name as supplier_name',
            'suppliers.gst',
            'suppliers.Details',
            'items.name as item_name',
            'items.category_name',
            'items.description_item',


         ]);






      if ($request->date_from)
         $section_details->whereDate('date', '>=', $request->date_from);


      if ($request->date_to)
         $section_details->whereDate('date', '<=', $request->date_to);




      if ($request->supplier)
         $section_details->where('supplier', '=', $request->supplier);


      if ($request->entry)
         $section_details->where('stock_type', $request->entry);

      if ($request->section)
         $section_details->where('section', $request->section);


      $return =  $section_details->paginate(5);






      //   return response()->json(["data" =>  $return]);
      return  $return;
   }


   public function officeDashboardArrivalData(Request $request)
   {
      $section_details = DB::table('storearrivals')
         ->join('sections', 'sections.id', '=', 'storearrivals.section')
         ->join('items', 'items.id', '=', 'storearrivals.item_name')
         ->join('suppliers', 'suppliers.id', '=', 'storearrivals.supplier')



         ->select([

            'storearrivals.id',
            'storearrivals.date',
            'storearrivals.supplier',
            'storearrivals.quantity',
            'storearrivals.approvedquantity',
            'storearrivals.rejectedquantity',
            'storearrivals.stock_type',
            'storearrivals.price',
            'storearrivals.invoice',
            'storearrivals.invoice_date',
            'storearrivals.Dc_no',
            'storearrivals.Dc_date',
            'storearrivals.arrivals_page_no',
            'storearrivals.sign_of_insp_officer',
            'storearrivals.store_officer',
            'storearrivals.gem_officer',

            'storearrivals.remarks',
            'sections.name as section_name',
            'suppliers.name as supplier_name',
            'suppliers.gst',
            'suppliers.Details',
            'items.name as item_name',
            'items.category_name',
            'items.description_item',


         ]);






      if ($request->date_from) {

         $section_details->whereDate('date', '>=', $request->date_from);
      } else {

         $section_details->whereYear('date', Carbon::now()->year);
         $section_details->whereMonth('date', Carbon::now()->month);
      }



      if ($request->date_to)
         $section_details->whereDate('date', '<=', $request->date_to);




      if ($request->supplier)
         $section_details->where('supplier', '=', $request->supplier);


      if ($request->entry)
         $section_details->where('stock_type', $request->entry);

      if ($request->section)
         $section_details->where('section', $request->section);


      $return =  $section_details->paginate(5);






      //   return response()->json(["data" =>  $return]);
      return  $return;
   }





   public function officeGirdata(Request $request)
   {


      $gir_details = DB::table('stocks')
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

            'stocks.stock_type',
            'stocks.remarks',

            'stocks.purchase_order_no',
            'stocks.purchase_order_date',
            'stocks.category_book',

            'stocks.category_book_page_no',
            'stocks.gir_page_no',
            'stocks.arrivals_page_no',
            'sections.name as section_name',
            'items.category_name',
            'items.name as item_name',
            'items.description_item',


         ]);


      if ($request->date_from)
         $gir_details->whereDate('product_date', '>=', $request->date_from);


      if ($request->date_to)
         $gir_details->whereDate('product_date', '<=', $request->date_to);




      if ($request->item)
         $gir_details->where('item_id', '=', $request->item);


      if ($request->entry)
         $gir_details->where('stock_type', $request->entry);

      if ($request->section)
         $gir_details->where('section_id', $request->section);


      $return =   $gir_details->paginate(5);






      //   return response()->json(["data" =>  $return]);
      return  $return;
   }

   public function officeKardexdata(Request $request)
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
            'stocks.balance_quantity',
            'stocks.product_date',
            'stocks.product_id',
            'stocks.item_id',
            'stocks.stock_type',
            'stocks.remarks',
            'stocks.purchase_order_no',
            'stocks.purchase_order_date',
            'stocks.category_book',
            'sections.name as section_name',

            'stocks.category_book_page_no',
            'stocks.gir_page_no',
            'stocks.arrivals_page_no',
            'items.name as item_name',
            'items.category_name',
            'items.description_item',


         ])
         ->where('category_book', '=', 'DSR');




      if ($request->date_from)
         $goods_details->whereDate('product_date', '>=', $request->date_from);


      if ($request->date_to)
         $goods_details->whereDate('product_date', '<=', $request->date_to);




      if ($request->item)
         $goods_details->where('item_id', '=', $request->item);


      if ($request->entry)
         $goods_details->where('stock_type', $request->entry);

      if ($request->section)
         $goods_details->where('section_id', $request->section);


      $return =   $goods_details->paginate(5);






      //   return response()->json(["data" =>  $return]);
      return  $return;
   }

   public function officeDsrdata(Request $request)
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
            'stocks.balance_quantity',
            'stocks.product_date',
            'stocks.product_id',
            'stocks.item_id',
            'stocks.stock_type',
            'stocks.remarks',
            'stocks.purchase_order_no',
            'stocks.purchase_order_date',
            'stocks.category_book',
            'sections.name as section_name',

            'stocks.category_book_page_no',
            'stocks.gir_page_no',
            'stocks.arrivals_page_no',
            'items.name as item_name',
            'items.category_name',
            'items.description_item',


         ])
         ->where('category_book', '=', 'kardex');




      if ($request->date_from)
         $goods_details->whereDate('product_date', '>=', $request->date_from);


      if ($request->date_to)
         $goods_details->whereDate('product_date', '<=', $request->date_to);




      if ($request->item)
         $goods_details->where('item_id', '=', $request->item);


      if ($request->entry)
         $goods_details->where('stock_type', $request->entry);

      if ($request->section)
         $goods_details->where('section_id', $request->section);


      $return =   $goods_details->paginate(5);






      //   return response()->json(["data" =>  $return]);
      return  $return;
   }

   public function officeRejectedPagedata(Request $request)
   {
      $rejected_data = DB::table('storearrivals')
         ->join('sections', 'sections.id', '=', 'storearrivals.section')
         ->join('items', 'items.id', '=', 'storearrivals.item_name')
         ->join('suppliers', 'suppliers.id', '=', 'storearrivals.supplier')
         ->select([

            'storearrivals.id',
            'storearrivals.date',
            'storearrivals.supplier',
            'storearrivals.quantity',
            'storearrivals.approvedquantity',
            'storearrivals.rejectedquantity',
            'storearrivals.disposedstatus',
            'storearrivals.price',
            'storearrivals.invoice',
            'storearrivals.Dc_no',
            'storearrivals.Dc_date',
            'storearrivals.arrivals_page_no',
            'storearrivals.sign_of_insp_officer',
            'storearrivals.store_officer',
            'storearrivals.remarks',
            'storearrivals.rejectionremarks',
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
         ->where([['rejectedquantity', '!=', 0]]);



      if ($request->date_from)
         $rejected_data->whereDate('date', '>=', $request->date_from);


      if ($request->date_to)
         $rejected_data->whereDate('date', '<=', $request->date_to);




      if ($request->supplier)
         $rejected_data->where('supplier', '=', $request->supplier);


      if ($request->entry)
         $rejected_data->where('stock_type', $request->entry);

      if ($request->section)
         $rejected_data->where('section', $request->section);


      $return =   $rejected_data->paginate(5);






      //   return response()->json(["data" =>  $return]);
      return  $return;
   }
   public function officeGemConsigneedata(Request $request)
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
            'stocks.balance_quantity',
            'stocks.product_date',
            'stocks.product_id',
            'stocks.item_id',
            'stocks.stock_type',
            'stocks.remarks',
            'stocks.purchase_order_no',
            'stocks.purchase_order_date',
            'stocks.category_book',
            'sections.name as section_name',

            'stocks.category_book_page_no',
            'stocks.gir_page_no',
            'stocks.arrivals_page_no',
            'items.name as item_name',
            'items.category_name',
            'items.description_item',


         ])
         ->where('stock_type', '=', 'Gem-consignee');




      if ($request->date_from)
         $goods_details->whereDate('product_date', '>=', $request->date_from);


      if ($request->date_to)
         $goods_details->whereDate('product_date', '<=', $request->date_to);




      if ($request->item)
         $goods_details->where('item_id', '=', $request->item);




      if ($request->section)
         $goods_details->where('section_id', $request->section);


      $return =   $goods_details->paginate(5);






      //   return response()->json(["data" =>  $return]);
      return  $return;
   }
}
