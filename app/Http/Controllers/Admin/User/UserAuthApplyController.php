<?php

namespace App\Http\Controllers\Admin\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Main\User\UserAuthApply;
use App\Main\User\UserAuth;
use App\Main\User\User;
use App\Main\User\UserAttach;
use DB;

class UserAuthApplyController extends Controller
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
            $data = UserAuthApply::where($where)->whereNotIn('status', [1])->get();
        } else {
            $data = UserAuthApply::whereNotIn('status', [1])->get();
        }

        return view('admin.user.userAuthApply.index', compact('data', 'datemin', 'datemax'));

    }

    //用户审核
    public function auth(Request $request) {

        $data = UserAuthApply::where('id', $request->input('id', 0))->first();

        if ($request->isMethod('post'))
        {
            if ($data->status != 0)
            {
                return redirect()->back()->with('status', '提交成功！');
            }

            if ($request->input('status', 0) == 1)
            {
                DB::transaction(function () use ($data) {
                    UserAuthApply::where('id', $data->id)->update(['status' => 1, 'updatetime' => date('Y-m-d H:i:s')]);

                    UserAuth::insert([
                        'userId' => $data->userId,
                        'realname' => $data->realname,
                        'cardno' => $data->cardno,
                        'createtime' => date('Y-m-d H:i:s'),
                        'updatetime' => date('Y-m-d H:i:s')
                    ]);
                });

                return redirect()->back()->with('status', '提交成功！');
            } else {
                UserAuthApply::where('id', $data->id)->update(['status' => -1, 'updatetime' => date('Y-m-d H:i:s')]);

                return redirect()->back()->with('status', '提交成功！');
            }
        } else {
            $user = User::where('id', $data->userId)->first();

            $attach = [];

            $res = UserAttach::where('userId', $data->userId)->where('status', 1)->get();
            foreach ($res as $value)
            {
                $attach[$value->type] = $value->path;
            }

            return view('admin.user.userAuthApply.auth', compact('data', 'user', 'attach'));
        }

    }
}
