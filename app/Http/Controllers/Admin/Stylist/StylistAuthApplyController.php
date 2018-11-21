<?php

namespace App\Http\Controllers\Admin\Stylist;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Main\Stylist\StylistAuth;
use App\Main\Stylist\StylistAuthApply;
use App\Main\Stylist\StylistAttach;
use DB;

class StylistAuthApplyController extends Controller
{
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
            $data = StylistAuthApply::where($where)->whereNotIn('status', [1])->get();
        } else {
            $data = StylistAuthApply::whereNotIn('status', [1])->get();
        }

        return view('admin.stylist.stylistAuthApply.index', compact('data', 'datemin', 'datemax'));

    }

    public function auth(Request $request) {

        $data = StylistAuthApply::where('id', $request->input('id', 0))->first();

        if ($request->isMethod('post'))
        {
            if ($data->status != 0)
            {
                return redirect()->back()->with('status', '提交成功！');
            }

            if ($request->input('status', 0) == 1)
            {
                DB::transaction(function () use ($data) {
                    StylistAuthApply::where('id', $data->id)->update(['status' => 1, 'updatetime' => date('Y-m-d H:i:s')]);

                    StylistAuth::insert([
                        'stylistId' => $data->stylistId,
                        'realname' => $data->realname,
                        'cardno' => $data->cardno,
                        'createtime' => date('Y-m-d H:i:s'),
                        'updatetime' => date('Y-m-d H:i:s')
                    ]);
                });

                return redirect()->back()->with('status', '提交成功！');
            } else {
                StylistAuthApply::where('id', $data->id)->update(['status' => -1, 'updatetime' => date('Y-m-d H:i:s')]);

                return redirect()->back()->with('status', '提交成功！');
            }
        } else {
            $attach = $intelligence = [];

            $res = StylistAttach::where('stylistId', $data->stylistId)->where('status', 1)->get();
            foreach ($res as $value)
            {
                if ($value->type != 6)
                {
                    $attach[$value->type] = $value->path;
                } else {
                    $intelligence[] = $value->path;
                }
            }

            return view('admin.stylist.stylistAuthApply.auth', compact('data', 'attach', 'intelligence'));
        }
    }

}
