<?php
/**
 * Created by PhpStorm.
 * User: YL
 * Date: 2018/10/9
 * Time: 17:54
 */
namespace App\Http\Controllers\Html5;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
class IndexController extends Controller
{
    public function index1(Request $request)
    {
//        $session_val = session('wechat.oauth_user'); // 拿到授权用户资料
        return view('html5.welcome', []);
    }
    public function index(Request $request)
    {
        $data = $request->all();

        $session_val = session('wechat.oauth_user'); // 拿到授权用户资料

        Log::info("session_val:" . json_encode($session_val));
       /* return view('html5.welcome', ['aaa'=>'1']);*/
       return $session_val;
    }
   
}