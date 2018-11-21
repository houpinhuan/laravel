<?php

namespace App\Http\Controllers\Admin\Agency;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Main\Agency\AgencyLog;

class AgencyLogController extends Controller
{
    public function index(Request $request){

        if(! empty($request->input('idNo')))
        {
            $idNo=$request->input('idNo');
            $data=AgencyLog::where('agencyuserId',$idNo)->get();
        } else {
            $data=AgencyLog::get();
        }

        return view('admin.agency.agencyLog.index',compact('data','idNo'));

    }
}
