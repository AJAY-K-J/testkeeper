<?php

namespace App\Http\Controllers\sections;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Models\storearrival;
use Illuminate\Contracts\Cache\Store;

class SectionResponseController extends Controller
{





    public function confirm(Request $request)
    {


        $request->validate([

            'approvedquantity' => 'required|integer|min:1'

        ]);

        if ($request->id) {

            $record = storearrival::find($request->id);

            if ($record) {

                if ($record->quantity < $request->approvedquantity) {

                    return 'quantityError';
                } else {
                    $record->remarks = $request->remarks;

                    $record->approvedquantity = $request->approvedquantity;
                    $record->rejectedquantity =  $record->quantity - $request->approvedquantity;

                    $record->sign_of_insp_officer = 1;
                    $record->save();
                    return 'Success';
                }
            }
        };
    }



    public function reject(Request $request)
    {



        if ($request->id) {


            $request->validate([

                'rejectionremarks' => 'required',


            ]);
            $reject_record = storearrival::find($request->id);

            if ($reject_record) {

                $reject_record->rejectionremarks = $request->rejectionremarks . '|Rejected By.' . Auth::user()->name;
                $reject_record->rejectedquantity = $reject_record->quantity;
                $reject_record->sign_of_insp_officer = 2;
            }

            $reject_record->save();
            return 'Success';
        };
    }
}
