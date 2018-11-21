<?php

namespace App\Http\Controllers\Admin\Agency;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Main\Agency\AgencyOrder;
use App\Main\Agency\AgencyUser;
use Input;
use DB;

class OrderController extends Controller
{
    public function index(){

        $status = 1;
        if (Input::get('status')!=null){
            $status = Input::get('status');
            $data = AgencyOrder::where('status',$status) -> get();
        }else{
            $data = AgencyOrder::where('status',$status) -> get();
        }
        return view('admin.agency.agencyOrder.index',compact('data','status'));

    }

    public function auth(Request $request) {

        $data = AgencyOrder::where('id', $request->input('id'))->first();

        if ($request->isMethod('post'))
        {
            DB::transaction(function () use ($data, $request) {
                AgencyOrder::where('id', $request->input('id'))->update([
                    'status' => $request->input('status'),
                    'updatetime' => date('Y-m-d H:i:s')
                ]);

                if ($request->input('status') == 9)
                {
                    $salf = str_random(6);
                    $password = str_random(random_int(8, 12));

                    $id = AgencyUser::insertGetId([
                        'mobile' => $data->mobile,
                        'salf' => $salf,
                        'password' => md5(md5($password) . $salf),
                        'nickname' => $data->contact,
                        'createtime' => $data->updatetime,
                        'updatetime' => $data->updatetime
                    ]);

                    // 发送短信
                    if ($id)
                    {
                        event(new \App\Events\SendPwdEvent($id, $password, $data->mobile));
                    }
                }
            });

            return redirect()->back()->with('status', '提交成功！');

        } else {

            return view('admin.agency.agencyOrder.auth', compact('data'));

        }

    }
}
