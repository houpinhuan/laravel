<?php

namespace App\Http\Controllers\Admin\Uploader;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Storage;

class uploaderController extends Controller
{
    public function webuploader(Request $request)
    {
    	if ($request -> hasFile('file') && $request -> file('file')->isValid()) {
    		$filename = sha1(time().$request -> file('file') -> getClientOriginalName()).".".$request -> file('file') -> getClientOriginalExtension();
    		//文件保存/移动
    		Storage::disk('public') -> put($filename,file_get_contents($request -> file('file' ) -> path()));
    		//返回数据
    		$result = [
    			'errCode'	=> '0',
    			'errMsg'	=>	'',
    			'succMsg'	=>	'文件上传成功！',
    			'path'		=>	'/storage/'.$filename,
    		];
		}else{
			$result = [
				'errCode'	=> '000001',
				'errMsg'	=>	$request -> file('file') -> getErrorMessage(),
			];
		}
		//返回信息
		return response() -> json($result);

    }
}
