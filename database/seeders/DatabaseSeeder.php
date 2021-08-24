<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        for ($i=0; $i < 30; $i++) { 

        DB::table('storearrivals')->insert([

         


'date'=>Carbon::parse('2000-01-01'),
'supplier'=>'1',
'stock_type'=>'Local entry',
'item_name'=>'1',
'quantity'=>50,
'approvedquantity'=>'0',
'rejectedquantity'=>'0',
'disposedstatus'=>'0',
'price'=>'500',
'invoice'=>$i,
'invoice_date'=>Carbon::parse('2000-01-01'),
'Dc_no'=>'12546',
'Dc_date'=>Carbon::parse('2000-01-01'),
'section'=>'1',
'arrivals_page_no'=>$i,
'sign_of_ask'=>'1',
'sign_of_insp_officer'=>'0',
'store_officer'=>'0',
'gem_officer'=>'0',
'remarks'=>'no',
'rejectionremarks'=>'no',
            
        ]);

    }


    }
}
