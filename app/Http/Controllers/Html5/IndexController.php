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
class IndexController extends Controller
{
    public function index1(Request $request)
    {
//        $session_val = session('wechat.oauth_user'); // 拿到授权用户资料
        return view('html5.welcome', []);
    }
    public function index()
    {
        $userInfo = $this->getEasyWechatSession();
//根据微信信息注册用户。
        $userData = [
            'password' => bcrypt('123456'),
            'openid' => $userInfo['id'],
            'nickname' => $userInfo['nickname'],
        ];
        //注意批量写入需要把相应的字段写入User中的$fillable属性数组中
        $user = session('wechat.oauth_user.default');
        return $user;
    }
}