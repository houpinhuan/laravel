<?php namespace App\Http\Controllers\Admin\Agency;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Main\Agency\AgencyUser;
use App\Main\Agency\AgencyUserAsset;
use App\Main\Agency\AgencyUserAccountBind;

class UserController extends Controller
{

    public function index(Request $request) {

        if(!empty($request->input('idNo'))){
            $idNo=$request->input('idNo');
            $data=AgencyUser::where('id',$idNo)->get();
        }else{
            $data = AgencyUser::get();
        }
        return view('admin.agency.user.index', compact('data','idNo'));

    }

    public function reset(Request $request) {

        $data = AgencyUser::where('id', $request->input('id'))->first();

        if ($request->isMethod('post'))
        {
            if ($request->input('status'))
            {
                $password = str_random(random_int(8, 12));

                AgencyUser::where('id', $request->input('id'))->update([
                    'password' => md5(md5($password) . $data->salf),
                    'updatetime' => date('Y-m-d H:i:s')
                ]);

                event(new \App\Events\SendPwdEvent($data->id, $password, $data->mobile));
            }        

            return redirect()->back()->with('status', '重置成功！');
        } else {
            return view('admin.agency.user.reset', compact('data'));
        }

    }

    //提现绑定信息
    public function accountBind(Request $request){

        $data = AgencyUserAccountBind::where('agencyuserId',$request->input('id')) -> get();
        return view('admin.agency.user.accountBind',compact('data'));

    }

    //资产
    public function asset(Request $request){

        $data=AgencyUserAsset::where('agencyuserId',$request->input('id'))->first();
        return view('admin.agency.user.asset',compact('data'));

    }

}