<?php

namespace App\Http\Controllers\storekeeper;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Contracts\Service\Attribute\Required;
use App\Models\storearrival;
use App\Models\Item;
use App\Models\Section;
use App\Models\Supplier;
use App\Models\User;



use Illuminate\Support\Facades\DB;

class StoreArrivalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(auth()->check() && auth()->user()->role=='Store-Keeper')
        {
        $item_details = Item::all()->where('status', '=', '0');
        $section_details = Section::all()->where('status', '=', '1');
        $supplier_details = Supplier::all();
        $section_officer = User::all()->where('role', '=', 'section-in-charge');
        return view('storekeeper.dashboard', compact('item_details', 'section_details', 'section_officer', 'supplier_details'));
        }else{
            return redirect('/');
        }
    
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

            'date' => 'Required',
            'quantity' => 'required|integer|min:1',

            'supplier' => 'Required',
            'price' => "required|regex:/^\d+(\.\d{1,2})?$/",
            'section' => 'Required',
            'stock_type' => 'Required',
            'invoice' => 'Required',
            'invoice_date' => 'Required',
            'item_name' => 'Required',


        ]);


        if ($request->id) {
            $store = storearrival::find($request->id);
        } else
            $store = new storearrival;
        if ($request->date) {
            $store->date = $request->date;
        }
        if ($request->quantity) {
            $store->quantity = $request->quantity;
        }
        if ($request->Dc_date) {
            $store->Dc_date = $request->Dc_date;
        } else {
            $store->Dc_date = $request->date;
        }

        if ($request->supplier) {
            $store->supplier = $request->supplier;
        }
        if ($request->price) {
            $store->price = $request->price;
        }
        if ($request->section) {
            $store->section = $request->section;
        }
        if ($request->stock_type) {
            $store->stock_type = $request->stock_type;
        }

        if ($request->stock_type == 'Gem-consignee') {
            $store->gem_officer = 1;
        }


        if ($request->invoice) {
            $store->invoice = $request->invoice;
        }
        if ($request->invoice_date) {
            $store->invoice_date = $request->invoice_date;
        }


        if ($request->arrivals_page_no) {
            $store->arrivals_page_no = $request->arrivals_page_no;
        }
        if ($request->item_name) {
            $store->item_name = $request->item_name;
        }

        if ($request->Dc_no) {
            $store->Dc_no = $request->Dc_no;
        }
        if ($request->remarks) {
            $store->remarks = $request->remarks;
        } else  $store->remarks = 'No remarks';


        $store->rejectionremarks = 'No rejection remarks';


        $store->save();
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
        //
    }

    public function storeArrivalbook()

    {
        if(auth()->check() && auth()->user()->role=='Store-Keeper')
        {

        $section_details = Section::all()->where('status', '=', '1');
        $supplier_details = Supplier::all();


        return view('storekeeper.store_arrival_book',compact('section_details','supplier_details'));
        }else{
            return redirect('/');
        }
    }

    public function arrivalDetails(Request $request)
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



            $returns=$section_details->paginate(5);
       ;


      

       

           

            return response()->json(["data" =>  $returns,]);

        



    }

public function arrivalExport(Request $request){


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



  
$exportData=  $section_details->get();








return response()->json(["data" =>  $exportData]);







}




}
