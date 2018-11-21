<?php

namespace App\Http\Controllers\Admin\Agency;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Main\Agency\Agency;
use App\Main\Agency\AgencyUser;
use App\Main\Area\Area;
class AreaController extends Controller
{

    public function index(Request $request) {

    	$agencyuserId = $request->input('agencyuserId', '');

        if ($agencyuserId > 0)
        {
            $data = Agency::where('agencyuserId', $agencyuserId)->get();
        } else {
            $data = Agency::get();
        }

        return view('admin.agency.area.index', compact('data', 'agencyuserId'));

    }

    public function add(Request $request) {

    	if ($request->isMethod('post'))
    	{
            $data = $request->except('_token');
            if (empty($data['cityId'])){
                $data['level']=3;
                $data['areaId']=$data['provinceId'];
            }elseif(empty($data['districtId'])){
                $data['level']=2;
                $data['areaId']=$data['cityId'];
            }else{
                $data['level']=1;
                $data['areaId']=$data['districtId'];
            }
            unset($data['provinceId'],$data['cityId'],$data['districtId']);
            $data['createtime']=$data['updatetime']=date('Y-m-d H:i:s');
            Agency::insert($data);
            return redirect()->back()->with('status','添加成功！');
    	} else {
    	    $agencyuserId=Agency::select('agencyuserId')->get()->toArray();
    	    $data = AgencyUser::whereNotIn('id',$agencyuserId)->select('id')->get();
    		return view('admin.agency.area.add',compact('data'));

    	}

    }

    public function update(Request $request){

        if ($request->isMethod('post')){
            $data=$request->except('_token');
            $data['updatetime']=date('Y-m-d H:i:s');
            Agency::where('id',$request->input('id'))->update($data);
            return redirect()->back()->with('status','编辑成功！');
        }else{
            $data = Agency::where('id',$request->input('id'))->first();
            $agencyuserId=explode(' ',$data->agencyuserId);
            $agencyuserId=Agency::whereNotIn('agencyuserId',$agencyuserId)->select('agencyuserId')->get()->toArray();
            $id=AgencyUser::whereNotIn('id',$agencyuserId)->select('id')->get();
            for ($i=1;$i<=3;$i++){
                $result=Area::where('id',$data->areaId)->first();
                $res[]=$result->name;
                $data->areaId=$result->parentId;
            }
            return view('admin.agency.area.update',compact('id','data','res'));
        }

    }
}