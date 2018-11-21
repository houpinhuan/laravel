<?php

namespace App\Http\Controllers\Admin\Coin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Main\Coin\Coin;
use Input;

class CoinController extends Controller
{
    public function index(){

        $data = Coin::get();
        return view('admin.coin.index',compact('data'));

    }
}
