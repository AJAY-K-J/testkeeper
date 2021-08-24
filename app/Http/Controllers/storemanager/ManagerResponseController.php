<?php

namespace App\Http\Controllers\storemanager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\storearrival;

class ManagerResponseController extends Controller
{







    public function confirm(Request $request)
    {


        if ($request->id) {

            $record = storearrival::find($request->id);

            if ($record) {
                $record->remarks = $request->remarks;
                $record->store_officer = 1;
            }

            $record->save();
            return 'Success';
        };
    }



    public function reject(Request $request)
    {

        if ($request->id) {

            $reject_record = storearrival::find($request->id);

            if ($reject_record) {
                $reject_record->remarks = $request->remarks;
                $reject_record->store_officer = 2;
            }

            $reject_record->save();
            return 'Success';
        };
    }
}
