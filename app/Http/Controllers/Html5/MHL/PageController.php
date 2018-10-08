<?php
/**
 * 首页控制器
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/20 0020
 * Time: 20:15
 */

namespace App\Http\Controllers\Html5\MHL;

use App\Components\ADManager;
use App\Components\AdminManager;
use App\Components\QNManager;
use App\Components\TWStepManager;
use App\Components\Utils;
use App\Http\Controllers\ApiResponse;
use App\Libs\CommonUtils;
use App\Models\AD;
use Illuminate\Http\Request;
use App\Libs\ServerUtils;
use App\Components\RequestValidator;
use Illuminate\Support\Facades\Redirect;


class PageController
{

    //麻环岭介绍页面
    /*
     * By TerryQi
     *
     * 2018-09-20
     */
    public function intro(Request $request)
    {
        return view('html5.mhl.intro', []);
    }

}







