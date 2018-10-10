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
/*use Yansongda\Pay\Pay;
use Illuminate\Http\Request;*/


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
        $response =  $app->template_message->getIndustry();
       /* $app->server->push(function ($message) {
            $app = app('wechat.official_account');

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
                // ... 其它消息
                default:
//                    return '';
                    break;
            }
        });*/
//        $response = $app->template_message->sendSubscription([
//            'touser' => 'user-openid',
//            'template_id' => 'template-id',
//            'url' => 'https://easywechat.org',
//            'scene' => 1000,
//            'data' => [
//                'baz' => ['value' => '你好', 'color' => '#550038'], // 与第二种一样
//        ],
//    ]);
//        $user = $app->user->list();
        return $response;
    }


}