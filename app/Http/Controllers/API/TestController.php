<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/25
 * Time: 14:54
 */

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Components\RequestValidator;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiResponse;

class TestController extends Controller
{
    /*
     * 为客户端首页获取轮播图
     *
     * By ouyang
     *
     * 2018-02-25
     *
     */
    public function test(Request $request)
    {
        $data = $request->all();

        //合规校验
        $requestValidationResult = RequestValidator::validator($request->all(), [
            'test' => 'required',            //测试参数
        ]);
        if ($requestValidationResult !== true) {
            return ApiResponse::makeResponse(false, $requestValidationResult, ApiResponse::MISSING_PARAM);
        }

        $test = $data['test'];

        return ApiResponse::makeResponse(true, $test, ApiResponse::SUCCESS_CODE);
    }
}