<?php namespace App\Http\Controllers\Admin\Agency;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Main\Agency\AgencyUserTake;
use Excel;

class UserTakeController extends Controller
{

    public function index(Request $request){

        $status = 1;
        if ($request->input('status')!=null){
            $status = $request->input('status');
            $data = AgencyUserTake::where('status',$status)->get();
        }else{
            $data = AgencyUserTake::where('status',$status)->get();
        }
        return view('admin.agency.UserTake.index',compact('data','status'));

    }

    public function auth(Request $request){

        if ($request->isMethod('post')){
            if ($request->input('status')!=null){
                AgencyUserTake::where('id',$request->input('id'))->update(['status'=>$request->input('status'),'updatetime'=>date('Y-m-d H:i:s')]);
                return redirect()->back()->with('status','提交成功！');
            }
        }else{
            $data=AgencyUserTake::where('id',$request->input('id'))->first();
            return view('admin.agency.UserTake.auth',compact('data'));
        }

    }

    public function export(Request $request){

        //表头
        $cellData = [
            ['昵称','真实名称','手机号码','证件号码','账号类型','账号','账户附加支行信息','金额','手续费','状态','创建时间']
        ];
        //查询数据
        $data = AgencyUserTake::where('status',$request->input('status')) -> orderBy('createtime','desc') -> get();
        foreach ($data as $value){
            if ($request->input('status')==1){
                $status='申请中';
            }else{
                $status='已完成';
            }
            $cellData[] = [$value -> user -> nickname, $value -> realname, $value -> user -> mobile, $value -> idcard, $value -> accounttype, $value -> accountno, $value -> accountbranch, $value -> amount, $value -> fee, $status,$value -> createtime];
        }
        Excel::create(sha1(time().rand(1000,9999)),function ($excel) use ($cellData){
            $excel -> sheet('代理提现信息',function ($sheet) use ($cellData){
                $sheet -> rows($cellData);
            });
        }) -> export('xls');

    }
}
