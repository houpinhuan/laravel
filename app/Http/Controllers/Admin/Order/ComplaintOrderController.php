<?php

namespace App\Http\Controllers\Admin\Order;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Main\Complaint\ComplaintOrder;
use App\Main\Complaint\ComplaintOption;
use Input;

class ComplaintOrderController extends Controller
{
    public function index(){

        $data = ComplaintOrder::get();
        return view('admin.order.complaintOrder.index',compact('data'));

    }

    public function complaint(){

        $data = ComplaintOrder::where('id',Input::get('id')) -> get();
        $description = $data[0] -> description;
        $complaint = $data[0] -> complaint;
        $complaint = explode(',',$complaint);
        $data = ComplaintOption::whereIn('id',$complaint) -> get() -> toArray();
        return view('admin.order.complaintOrder.complaint',compact('description','data'));

    }
}
