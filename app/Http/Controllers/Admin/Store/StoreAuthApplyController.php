<?php

namespace App\Http\Controllers\Admin\Store;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Main\Store\StoreAuth;
use App\Main\Store\StoreAuthApply;
use App\Main\Store\StoreAttach;
use App\Main\Store\Store;
use DB;

class StoreAuthApplyController extends Controller
{
    //门店审核列表
    public function index(Request $request) {

        $where = [];

        if (! empty($request->input('datemin')))
        {
            $where[] = ['createtime', '>=', date('Y-m-d H:i:s', strtotime($request->input('datemin')))];
        }

        if (! empty($request->input('datemax')))
        {
            $where[] = ['createtime', '<=', date('Y-m-d H:i:s', strtotime($request->input('datemax') + 86400))];
        }

        if (! empty($where))
        {
            $data = StoreAuthApply::where($where)->whereNotIn('status', [1])->get();
        } else {
            $data = StoreAuthApply::whereNotIn('status', [1])->get();
        }

        return view('admin.store.storeAuthApply.index', compact('data', 'datemin', 'datemax'));

    }

    //门店审核
    public function auth(Request $request){

        $data = StoreAuthApply::where('id', $request->input('id', 0))->first();

        if ($request->isMethod('post'))
        {
            if ($data->status != 0)
            {
                return redirect()->back()->with('status', '提交成功！');
            }

            if ($request->input('status', 0) == 1)
            {
                DB::transaction(function () use ($data) {
                    StoreAuthApply::where('id', $data->id)->update(['status' => 1, 'updatetime' => date('Y-m-d H:i:s')]);

                    StoreAuth::insert([
                        'storeId' => $data->storeId,
                        'realname' => $data->realname,
                        'cardno' => $data->cardno,
                        'licenseno' => $data->licenseno,
                        'createtime' => date('Y-m-d H:i:s'),
                        'updatetime' => date('Y-m-d H:i:s')
                    ]);
                });

                return redirect()->back()->with('status', '提交成功！');
            } else {
                StoreAuthApply::where('id', $data->id)->update(['status' => -1, 'updatetime' => date('Y-m-d H:i:s')]);

                return redirect()->back()->with('status', '提交成功！');
            }
        } else {
            $auth = Store::where('id', $data->storeId)->first();

            $attach = [];

            $res = StoreAttach::where('storeId', $data->storeId)->where('status', 1)->get();
            foreach ($res as $value)
            {
                $attach[$value->type] = $value->path;
            }

            return view('admin.store.storeAuthApply.auth', compact('data', 'auth', 'attach'));
        }
    }

}
