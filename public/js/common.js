// 接口部分
//基本的ajax访问后端接口类
function ajaxRequest(url, param, method, callBack) {
    console.log("url:" + url + " method:" + method + " param:" + JSON.stringify(param));
    $.ajax({
        type: method,  //提交方式
        url: url,//路径
        data: param,//数据，这里使用的是Json格式进行传输
        contentType: "application/json", //必须有
        dataType: "json",
        success: function (ret) {//返回数据根据结果进行相应的处理
            console.log("ret:" + JSON.stringify(ret));
            callBack(ret)
        },
        error: function (err) {
            console.log(JSON.stringify(err));
            console.log("responseText:" + err.responseText);
            callBack(err)
        }
    });
}

//设置管理员状态
function setAdminStatus(url, param, callBack) {
    ajaxRequest(url + "admin/admin/setStatus/" + param.id, param, "GET", callBack);
}

//设置农产品类型状态
function setFarmGoodsTypeStatus(url, param, callBack) {
    ajaxRequest(url + "admin/farm/goodsType/setStatus/" + param.id, param, "GET", callBack);
}

//设置农产品状态
function setFarmGoodsStatus(url, param, callBack) {
    ajaxRequest(url + "admin/farm/goods/setStatus/" + param.id, param, "GET", callBack);
}

//设置农场状态
function setFarmStatus(url, param, callBack) {
    ajaxRequest(url + "admin/farm/farm/setStatus/" + param.id, param, "GET", callBack);
}

//设置农场下的大棚状态
function setGreenHouse(url, param, callBack) {
    ajaxRequest(url + "admin/farm/greenHouse/setStatus/" + param.id, param, "GET", callBack);
}

//设置大棚下的地状态
function setHouseLand(url, param, callBack) {
    ajaxRequest(url + "admin/farm/houseLand/setStatus/" + param.id, param, "GET", callBack);
}

//设置合作企业状态
function setEnterpriseStatus(url, param, callBack) {
    ajaxRequest(url + "admin/enterprise/setStatus/" + param.id, param, "GET", callBack);
}

//设置资讯分类状态
function setZXTypeStatus(url, param, callBack) {
    ajaxRequest(url + "admin/zx/zxType/setStatus/" + param.id, param, "GET", callBack);
}

//设置资讯状态
function setZXStatus(url, param, callBack) {
    ajaxRequest(url + "admin/zx/zx/setStatus/" + param.id, param, "GET", callBack);
}

//删除资讯
function delZX(url, param, callBack) {
    ajaxRequest(url + "admin/zx/zx/del/" + param.id, param, "GET", callBack);
}

//删除企业资讯
function delEnterpriseZX(url, param, callBack) {
    ajaxRequest(url + "admin/enterprise/zx/del/" + param.id, param, "GET", callBack);
}

//删除企业商品
function delEnterpriseGoods(url, param, callBack) {
    ajaxRequest(url + "admin/enterprise/goods/del/" + param.id, param, "GET", callBack);
}

//编辑图文详情
function editTW(url, param, callBack) {
    $.post(url + "admin/twStep/edit", param, callBack);
}

//删除图文详情
function delTW(url, param, callBack) {
    ajaxRequest(url + "admin/twStep/del/" + param.id, param, "get", callBack);
}

//设置商品状态
function setGoodsStatus(url, param, callBack) {
    ajaxRequest(url + "admin/goods/setStatus/" + param.id, param, "GET", callBack);
}

// 设置商品是否精品
function setGoodsSuperior(url, param, callBack) {
    ajaxRequest(url + "admin/goods/setSuperior/" + param.id, param, "GET", callBack);
}

//删除商品
function delGoods(url, param, callBack) {
    ajaxRequest(url + "admin/goods/del/" + param.id, param, "GET", callBack);
}

//删除商品视频源
function delVideo(url, param, callBack) {
    ajaxRequest(url + "admin/video/del/" + param.id, param, "GET", callBack);
}


//////////////////////////////////////////////////////////////////////////////////////////////////


/*
 * 校验手机号js
 *
 * By TerryQi
 */

function isPoneAvailable(phone_num) {
    var myreg = /^[1][3,4,5,7,8][0-9]{9}$/;
    if (!myreg.test(phone_num)) {
        return false;
    } else {
        return true;
    }
}

// 判断参数是否为空
function judgeIsNullStr(val) {
    if (val == null || val == "" || val == undefined || val == "未设置") {
        return true
    }
    return false
}

// 判断参数是否为空
function judgeIsAnyNullStr() {
    if (arguments.length > 0) {
        for (var i = 0; i < arguments.length; i++) {
            if (!isArray(arguments[i])) {
                if (arguments[i] == null || arguments[i] == "" || arguments[i] == undefined || arguments[i] == "未设置" || arguments[i] == "undefined") {
                    return true
                }
            }
        }
    }
    return false
}

// 判断数组时候为空, 服务于 judgeIsAnyNullStr 方法
function isArray(object) {
    return Object.prototype.toString.call(object) == '[object Array]';
}


// 七牛云图片裁剪
function qiniuUrlTool(img_url, type) {
    //如果不是七牛的头像，则直接返回图片
    //consoledebug.log("img_url:" + img_url + " indexOf('isart.me'):" + img_url.indexOf('isart.me'));
    if (img_url.indexOf('7xku37.com') < 0 && img_url.indexOf('isart.me') < 0) {
        return img_url;
    }
    //七牛链接
    var qn_img_url;
    const size_w_500_h_200 = '?imageView2/2/w/500/h/200/interlace/1/q/75|imageslim'
    const size_w_200_h_200 = '?imageView2/2/w/200/h/200/interlace/1/q/75|imageslim'
    const size_w_500_h_300 = '?imageView2/2/w/500/h/300/interlace/1/q/75|imageslim'
    const size_w_500_h_250 = '?imageView2/2/w/500/h/250/interlace/1/q/75|imageslim'

    const size_w_500 = '?imageView1/1/w/500/interlace/1/q/75'

    //除去参数
    if (img_url.indexOf("?") >= 0) {
        img_url = img_url.split('?')[0]
    }
    //封装七牛链接
    switch (type) {
        case "ad":  //广告图片
            qn_img_url = img_url + size_w_500_h_300
            break
        case "folder_list":  //作品列表图片样式
            qn_img_url = img_url + size_w_500_h_200
            break;
        case "folder_list_500":  //作品列表
            qn_img_url = img_url + size_w_500_h_300
            break;
        case  'head_icon':      //头像信息
            qn_img_url = img_url + size_w_200_h_200
            break
        case  'work_detail':      //作品详情的图片信息
            qn_img_url = img_url + size_w_500
            break
        default:
            qn_img_url = img_url
            break
    }
    return qn_img_url
}


// 文字转html，主要是进行换行转换
function Text2Html(str) {
    if (str == null) {
        return "";
    } else if (str.length == 0) {
        return "";
    }
    str = str.replace(/\r\n/g, "<br>")
    str = str.replace(/\n/g, "<br>");
    return str;
}

//null变为空str
function nullToEmptyStr(str) {
    if (judgeIsNullStr(str)) {
        str = "";
    }
    return str;
}


/*
 * 获取url中get的参数
 *
 * By TerryQi
 *
 * 2017-12-23
 *
 */
function getQueryString(name) {
    var reg = new RegExp('(^|&)' + name + '=([^&]*)(&|$)', 'i');
    var r = window.location.search.substr(1).match(reg);
    if (r != null) {
        return unescape(r[2]);
    }
    return null;
}


