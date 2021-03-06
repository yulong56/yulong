<?php
/**
 * Created by PhpStorm.
 * User: HappyQi
 * Date: 2018/1/11
 * Time: 9:43
 */

namespace App\Http\Controllers\API;


use App\Components\DateTool;
use App\Http\Controllers\Controller;
/*use EasyWeChat\Kernel\Messages\Image;
use EasyWeChat\Kernel\Messages\News;
use EasyWeChat\Kernel\Messages\NewsItem;
use EasyWeChat\Kernel\Messages\Text;
use EasyWeChat\Kernel\Messages\Video;
use EasyWeChat\Kernel\Messages\Voice;*/
use Illuminate\Support\Facades\Log;
/*use Yansongda\Pay\Pay;*/
use Illuminate\Http\Request;
use EasyWeChat\Kernel\Messages\Text;


class WeChatController extends Controller
{


    /**
     * 处理微信的请求消息
     *
     * 消息包括
     *
     * @return string
     */
    public function serve()
    {
        Log::info(__METHOD__ . " " . 'request arrived.'); # 注意：Log 为 Laravel 组件，所以它记的日志去 Laravel 日志看，而不是 EasyWeChat 日志
        $app = app('wechat.official_account');
        $app->server->push(function ($message) {
            $app = app('wechat.official_account');
            Log::info(__METHOD__ . " " . "server receive:" . json_encode($message));
            $user_openid = $message['FromUserName'];  //用户公众号openid
            Log::info(__METHOD__ . " " . 'user_openid:' . $user_openid);
            $wechat_user = $app->user->get($user_openid);        //通过用户openid获取信息
            Log::info(__METHOD__ . " " . 'wechat_user:' . json_encode($wechat_user));
            //根据消息类型分别进行处理
            switch ($message['MsgType']) {
                case 'event':
                    //点击事件
                    if ($message['Event'] == 'CLICK') {
                        switch ($message['EventKey']) {

                        }
                    }
                    //关注事件
                    if ($message['Event'] == 'subscribe') {

                    }
                    //取消关注事件
                    if ($message['Event'] == 'unsubscribe') {

                    }
                    //扫描进入事件
                    if ($message['Event'] == 'SCAN') {

                    }
                    break;
                case 'text':        //文本消息
                    Log::info(__METHOD__ . " " . "message:" . json_encode($message));
                    $text = $message['Content'];
                    Log::info(__METHOD__ . " " . "text:" . $text);
//                    $text_msg = new Text($text);
//                    $app->customer_service->message($text_msg)
//                        ->to($user_openid)
//                        ->send();
                    $app->template_message->send([
                        'touser' => $user_openid,
                        'template_id' => 'QpJ8X8USJTC7lvEpAQQ35U0zsAtd3kkiIvbCzrElwj8',
                        'url' => 'http://foryulong.isart.me',
                        'data' => [
                            'foo' => '你好',
                        ]
                    ]);
                    break;
                case 'image':

                    break;
                case 'voice':

                    break;
                case 'video':

                    break;
                case 'location':

                    break;
                case 'link':

                    break;
            }
        });
        $response = $app->server->serve();
        return $response;
//        Log::info(__METHOD__ . " " . 'request arrived.'); # 注意：Log 为 Laravel 组件，所以它记的日志去 Laravel 日志看，而不是 EasyWeChat 日志
//        $app = app('wechat.official_account');
//        $app->server->push(function ($message) {
//            $app = app('wechat.official_account');
//
//            //根据消息类型分别进行处理
//            switch ($message['MsgType']) {
//                case 'event':
//                    //点击事件
//                    if ($message['Event'] == 'CLICK') {
//                        switch ($message['EventKey']) {
//
//                        }
//                    }
//                    //关注事件
//                    if ($message['Event'] == 'subscribe') {
//
//                    }
//                    //取消关注事件
//                    if ($message['Event'] == 'unsubscribe') {
//
//                    }
//                    //扫描进入事件
//                    if ($message['Event'] == 'SCAN') {
//
//                    }
//                    break;
//                case 'text':        //文本消息
//
//                    break;
//                case 'image':
//
//                    break;
//                case 'voice':
//
//                    break;
//                case 'video':
//
//                    break;
//                case 'location':
//
//                    break;
//                case 'link':
//
//                    break;
//                // ... 其它消息
//                default:
////                    return '';
//                    break;
//            }
//        });
//        $response = $app->server->serve();
//        return $response;
    }
    public function template(Request $request)
    {
        $app = app('wechat.official_account');
        $res = $app->template_message->sendSubscription([
            'touser' => 'o6DOM1Uunt_-vtxsbNtEby933COY',
            'template_id' => 'C_USwh9Af6oPS5db1g-M4Bsozk7BBpIGKjLc5RPUAWE',
            'url' => 'http://foryulong.isart.me',
            'scene' => 1000,
            'data' => [
                'zoo' => ['value' => '你好'],
            ]
        ]);
        return $res;
    }

}