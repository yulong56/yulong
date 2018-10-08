<?php
/**
 * Created by PhpStorm.
 * User: HappyQi
 * Date: 2017/12/4
 * Time: 9:23
 */

namespace App\Components;


class Utils
{
    //分页配置
    const PAGE_SIZE = 15;

    //测试主机和生产主机URL地址
    const PRODUCT_SERVER_URL = 'http://art.syatc.cn/';

    //短信模板//////////////////////////////////////////////////////////////////////////////

    const VOTE_SMS_TEMPLATE_COMPLAIN = "423564461";     //投诉提醒
    const VOTE_SMS_TEMPLATE_ACTIVITY_NOTE_VALID = "423570740";      //活动未激活体系性
    const VOTE_SMS_TEMPLATE_AUDIT_NOTICE = "430645280";  //选手待审核提醒

    //短信模板//////////////////////////////////////////////////////////////////////////////


    //公众号账号配置
    const OFFICIAL_ACCOUNT_CONFIG_VAL = ['isart' => 'wechat.official_account.isart'];

    //获取配置信息
    public static function getPaymentConfig($busi_name)
    {
        $config = null;
        switch ($busi_name) {
            case "isart":
                $config = [
                    'appid' => '', // APP APPID
                    'app_id' => env('ISART_FWH_APPID', ''), // 公众号 APPID
                    'miniapp_id' => '',       //小程序miniapp_id
                    'mch_id' => env('ISART_FWH_MCH_ID', ''),                    // 微信商户号
                    'key' => env('ISART_FWH_MCH_KEY', ''),                     // 微信支付签名秘钥  ImpYNtH4B5x7C587qy5ujzS6fbZnNv6T
                    'notify_url' => env('ISART_FWH_MCH_NOTIFY_URL', ''),//'http://waibao.isart.me/api/sjdl/order/payNotify',      //支付结果通知地址  https://tclm.isart.me/api/wechat/notify
                    'cert_client' => app_path() . '/cert/isart_apiclient_cert.pem',        // 客户端证书路径，退款时需要用到
                    'cert_key' => app_path() . '/cert/isart_apiclient_key.pem',             // 客户端秘钥路径，退款时需要用到
                    'log' => [ // optional
                        'file' => app_path() . '/../storage/logs/isart_wechat.log',
                        'level' => 'debug'
                    ]
                ];
                break;
            case "mryh":
                $config = [
                    'appid' => '', // APP APPID
                    'app_id' => '', // 公众号 APPID
                    'miniapp_id' => env('MRYH_XCX_APPID', ''),       //小程序miniapp_id
                    'mch_id' => env('ISART_FWH_MCH_ID', ''),                    // 微信商户号
                    'key' => env('ISART_FWH_MCH_KEY', ''),                     // 微信支付签名秘钥  ImpYNtH4B5x7C587qy5ujzS6fbZnNv6T
                    'notify_url' => env('MRYH_FWH_MCH_NOTIFY_URL', ''),//'http://waibao.isart.me/api/sjdl/order/payNotify',      //支付结果通知地址  https://tclm.isart.me/api/wechat/notify
                    'cert_client' => app_path() . '/cert/isart_apiclient_cert.pem',        // 客户端证书路径，退款时需要用到
                    'cert_key' => app_path() . '/cert/isart_apiclient_key.pem',             // 客户端秘钥路径，退款时需要用到
                    'log' => [ // optional
                        'file' => app_path() . '/../storage/logs/mryh_wechat.log',
                        'level' => 'debug'
                    ]
                ];
                break;
        }
        return $config;
    }

    //常量配置
    //性别
    const admin_role_val = ['0' => '超级管理员', '1' => '运营管理员'];

    //登录账号类型
    const ACCOUNT_TYPE_TEL_PASSWD = "tel_passwd";       //手机号加密码
    const ACCOUNT_TYPE_TEL_CODE = "tel_code";        //手机号加随机密码
    const ACCOUNT_TYPE_XCX = "xcx";     //小程序
    const ACCOUNT_TYPE_FWH = "fwh";     //公众号

    //登录账号
    const ACCOUNT_TYPE_VAL = ['xcx' => '小程序', 'fwh' => '公众号', 'tel_passwd' => '手机号密码', '手机号随机码' => 'tel_code'];

    //用户性别
    const user_gender_val = ['0' => '保密', '1' => '男', '2' => '女'];
    //用户状态
    const user_status_val = ['0' => '冻结', '1' => '正常'];
    //用户类型
    const USER_TYPE_VAL = ['0' => '普通用户', '1' => '系统管理员'];

    //评论状态
    const COMMENT_READ_STATUS_VAL = ['0' => '未读', '1' => '已读'];
    const COMMENT_AUDIT_STATUS_VAL = ['0' => '待审核', '1' => '审核通过', '2' => '审核驳回'];
    const COMMENT_RECOMM_FLAG_VAL = ['0' => '未推荐', '1' => '已推荐'];

    //业务名称
    const BUSI_NAME_VAL = ['isart' => 'ISART公众号', 'mryh' => '每日一画', 'ysb' => '艺术榜'];

    //作品相关标示位
    const ARTICLE_STAUS_VAL = ['0' => '失效', '1' => '生效'];
    const ARTICLE_PRI_FLAG_VAL = ['0' => '公开', '1' => '私有'];
    const ARTICLE_ALLOW_COMMENT_FLAG_VAL = ['0' => '不允许评论', '1' => '允许评论'];
    const ARTICLE_ORI_FLAG_VAL = ['0' => '非原创', '1' => '原创'];
    const ARTICLE_APPLY_RECOMM_FLAG_VAL = ['0' => '不申请精华', '1' => '申请精华'];
    const ARTICLE_RECOMM_FLAG_VAL = ['0' => '不推荐', '1' => '推荐'];
    const ARTICLE_AUDIT_STATUS_VAL = ['0' => '待审核', '1' => '审核通过', '2' => '审核驳回'];
    const ARTICLE_SYS_FLAG_VAL = ['0' => '非系统', '1' => '系统'];

    //FTable定义
    const F_TABLB_ARTICLE = "article";
    const F_TABLE_ARTICLE_VAL = [self::F_TABLB_ARTICLE => '作品'];

    //关联关系级别
    const USER_REL_LEVEL_VAL = ['0' => '新用户', '1' => '促活'];

    // 操作值定义
    const OPT_FINISHED = "FINISHED";        //已完成
    const OPT_HANDLING = "HANDLING";        //处理中

    //操作类型定义
    const OPT_TYPE_ACTIVITY = "activity";   //活动

    //规则位置定义-规则位置完全自定义，需要与技术组明确
    const RULE_POSITION_VAL = ['1' => '1号位置', '2' => '2号位置', '3' => '3号位置', '4' => '4号位置', '5' => '5号位置'];

    //处理状态
    const FEEDBACK_STATUS_VAL = ['0' => '待处理', '1' => '处理中', '2' => '处理完成'];

    /******公众号*************/

    //公众号素材类型
    const MATERIAL_TYPE_VAL = ['image' => '图片', 'voice' => '语音', 'video' => '视频', 'thumb' => '缩略图', 'article' => '图文'];
    //公众号消息种类
    const MESSAGE_TYPE_VAL = ['text' => '文本消息', 'image' => '图片消息', 'video' => '视频消息', 'voice' => '声音消息', 'news' => '图文消息'];
    //公众号业务话术
    const NORMAL_TEMPLATE_VAL = ['TEMPLATE_SUBSCRIBE' => '关注事件模板'];
    //公众号菜单类型
    const MENU_TYPE_VAL = ['view' => '网页链接', 'media_id' => '素材', 'miniprogram' => '小程序', 'click' => '自定义事件'];

    /**************************/


    /******投票活动*************/

    //单日单用户投票数大于多少启动校验码机制
    const DAILY_START_VOTE_VERTIFY_NUM = 50;

    //投票分享标签-是否启用泛域名
    const VOTE_SHARE_DEBUG = false;

    //投票模式
    const VOTE_MODE_VAL = ['0' => '投票、礼物模式', '1' => '投票模式', '2' => '礼物模式'];
    //关注设置
    const SUBSCRIBE_MODE_VAL = ['0' => '不需要关注', '1' => '投票需要关注', '2' => '参加活动需要关注', '3' => '参加、投票都需要关注'];
    //投票审核模式
    const VOTE_AUDIT_MODE_VAL = ['0' => '自动审核', '1' => '人工审核'];
    //验证码模式
    const VOTE_VERTIFY_MODE_VAL = ['0' => '无验证码', '1' => '有验证码'];
    //投票提醒模式
    const VOTE_NOTICE_MODE_VAL = ['0' => '不提醒', '1' => '提醒'];
    //投票广告位置
    const VOTE_AD_MODE_VAL = ['normal' => '普通广告', 'day5' => '倒计时5天广告', 'day4' => '倒计时4天广告'
        , 'day3' => '倒计时3天广告', 'day2' => '倒计时2天广告', 'day1' => '倒计时1天广告'];
    //广告显示模式
    const VOTE_SHOW_AD_MODE_VAL = ['0' => '不启用倒计时广告', '1' => '启用倒计时广告'];
    //活动状态
    const VOTE_ACTIVITY_STATUS_VAL = ['0' => '未开始', '1' => '已开始', '2' => '已结束'];
    //活动激活状态
    const VOTE_ACTIVITY_VALID_STATUS_VAL = ['0' => '未激活', '1' => '已激活'];
    //结算状态
    const VOTE_ACTIVITY_IS_SETTLE_VAL = ['0' => '未结算', '1' => '已结算'];
    //投票状态
    const VOTE_VOTE_STATUS_VAL = ['0' => '未开始', '1' => '已开始', '2' => '已结束'];
    //报名状态
    const VOTE_APPLY_STATUS_VAL = ['0' => '未开始', '1' => '已开始', '2' => '已结束'];
    //用户审核状态
    const VOTE_USER_AUDIT_STATUS_VAL = ['0' => '未审核', '1' => '审核通过', '2' => '审核驳回'];
    //选手激活状态
    const VOTE_USER_VALID_STATUS_VAL = ['0' => '未激活', '1' => '已激活'];
    //选手基本状态
    const VOTE_USER_STATUS_VAL = ['0' => '停用', '1' => '正常'];
    //投诉状态
    const VOTE_COMPLAIN_STATUS_VAL = ['0' => '待解决', '1' => '已解决'];
    //选手类型
    const VOTE_USER_TYPE_VAL = ['0' => '机构报名', '1' => '自主报名'];
    //投票类型
    const VOTE_TYPE_VAL = ['0' => '普通投票', '1' => '付费投票'];
    //分享选手类型
    const VOTE_SHARE_TYPE_VAL = ['0' => '朋友圈分享', '1' => 'APP消息分享'];
    //投票订单支付状态
    const VOTE_ORDER_PAY_STATUS_VAL = ['0' => '待支付', '1' => '支付成功', '2' => '已关闭', '3' => '退款中', '4' => '退款成功', '5' => '退款失败'];

    /**************************/


    /******每日一画*************/

    const MRYH_AD_TYPE_VAL = ['none' => '不跳转', 'url' => '跳转链接', 'content' => '配置内容'];

    const MRYH_GAME_TYPE_VAL = ['0' => '自定义活动', '1' => '周活动', '2' => '月活动', '3' => '主题活动'];
    const MRYH_GAME_ADMIN_TYPE_VAL = ['1' => '周活动', '2' => '月活动', '3' => '主题活动'];
    const MRYH_GAME_MODE_VAL = ['0' => '连续参与', '1' => '总计参与'];
    const MRYH_GAME_SHOW_FLAG_VAL = ['0' => '不展示', '1' => '展示'];
    const MRYH_GAME_RECOMM_FLAG_VAL = ['0' => '不推荐', '1' => '推荐'];
    const MRYH_GAME_STATUS_VAL = ['0' => '失效', '1' => '生效'];
    const MRYH_GAME_SHOW_STATUS_VAL = ['0' => '不展示', '1' => '展示'];
    const MRYH_GAME_JOIN_STATUS_VAL = ['0' => '不可参与', '1' => '可参与'];
    const MRYH_GAME_GAME_STATUS_VAL = ['0' => '未开始', '1' => '已开始', '2' => '已结束'];
    const MRYH_GAME_JIESUAN_STATUS_VAL = ['0' => '未结算', '1' => '已结算'];
    const MRYH_GAME_CREATOR_TYPE_VAL = ['0' => '管理员', '1' => '用户'];

    //订单支付状态
    const MRYH_ORDER_PAY_STATUS_VAL = ['0' => '待支付', '1' => '支付成功', '2' => '已关闭'];

    //参赛信息
    const MRYH_JOIN_GAME_STATUS_VAL = ['0' => '正在进行', '1' => '成功', '2' => '失败'];
    const MRYH_JOIN_JIESUAN_STATUS_VAL = ['0' => '未结算', '1' => '已结算'];

    //迎新优惠券编码
    const MRYH_COUPONS_CODE_VAL = ['FOR_FIRST_NEW', '迎新优惠券'];

    //优惠券使用状态
    const MRYH_COUPONS_USED_STATUS_VAL = ['0' => '未使用', '1' => '已使用', '2' => '已过期'];

    //提现相关
    const MRYH_WITHDRAW_CASH_WITHDRAW_STATUS = ['0' => '提交中', '1' => '提现成功', '2' => '提现失败'];

    //清分执行情况
    const MRYH_COMPUTE_PRIZE_COMPUTE_STATUS = ['0' => '未执行', '1' => '已执行'];


    /**************************/


    /*****艺术榜***************************/


    const YSB_AD_TYPE_VAL = ['none' => '不跳转', 'url' => '跳转链接', 'content' => '配置内容'];


    /**************************/

    /*
     * 判断一个对象是不是空
     *
     * By TerryQi
     *
     * 2017-12-23
     *
     */
    public static function isObjNull($obj)
    {
        if ($obj === null || $obj === "") {
            return true;
        }
        return false;
    }

    /*
     * 生成订单号-增加4个随机数位置
     *
     * By TerryQi
     *
     * 2017-01-12
     *
     */
    public static function generateTradeNo()
    {
        $trade_no = date('Ymd') . substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
        return $trade_no . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9);
    }

    /*
     * 获取随机数
     *
     * By TerryQi
     *
     * 2018-08-19
     */
    public static function getRandNum($length)
    {
        $rand_str = "";
        for ($i = 0; $i < $length; $i++) {
            $rand_str = $rand_str . rand(0, 9);
        }
        return $rand_str;
    }


    /*
     * 获取范围内的随机数
     *
     * By TerryQi
     *
     * 2018-08-25
     */
    public static function getRandInRang($start, $end)
    {
        return rand($start, $end);
    }


    /**
     * @param $url 请求网址
     * @param bool $params 请求参数
     * @param int $ispost 请求方式
     * @param int $https https协议
     * @return bool|mixed
     */
    public static function curl($url, $params = false, $ispost = 0, $https = 0)
    {
        $httpInfo = array();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.118 Safari/537.36');
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if ($https) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // 对认证证书来源的检查
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); // 从证书中检查SSL加密算法是否存在
        }
        if ($ispost) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
            curl_setopt($ch, CURLOPT_URL, $url);
        } else {
            if ($params) {
                if (is_array($params)) {
                    $params = http_build_query($params);
                }
                curl_setopt($ch, CURLOPT_URL, $url . '?' . $params);
            } else {
                curl_setopt($ch, CURLOPT_URL, $url);
            }
        }

        $response = curl_exec($ch);

        if ($response === FALSE) {
            //echo "cURL Error: " . curl_error($ch);
            return false;
        }
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $httpInfo = array_merge($httpInfo, curl_getinfo($ch));
        curl_close($ch);
        return $response;
    }

}