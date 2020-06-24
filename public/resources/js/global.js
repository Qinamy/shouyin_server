/*
 * copyrights  all rights reserved
 */

function globalShowLayerImage(src, width) {

    var img = "<img style='width:100%' src='" + src + "'/>";

    layer.open({
        type: 1,
        title: false,
        closeBtn: 1,
        area: width,
        skin: 'layui-layer-nobg', //没有背景色
        shadeClose: true,
        content: img
    });
}

function globalShowLayerDomById(domid, width) {
    layer.open({
        type: 1,
        title: false,
        closeBtn: 1,
        area: width,
        skin: 'layui-layer-nobg', //没有背景色
        shadeClose: true,
        content: $('#' + domid)
    });
}
function globalShowLayerDomByContent(content, width, height) {
    layer.open({
        type: 1,
        title: false,
        closeBtn: 1,
        area: [width, height],
        skin: 'layui-layer-rim', //没有背景色
        shadeClose: true,
        content: content
    });
}
function globalShowLayeriFrameBySrc(src, width, height) {
    var index = layer.open({
        type: 2,
        title: false,
        closeBtn: 1,
        area: [width, height],
        skin: 'layui-layer-nobg', //没有背景色
        shadeClose: true,
        content: src
    });
    return index;
}

function globalShowLayeriFrameNoShadeBySrc(src, width, height) {
    var index = layer.open({
        type: 2,
        title: false,
        closeBtn: 1,
        area: [width, height],
        skin: 'layui-layer-nobg', //没有背景色
        shadeClose: false,
        content: src
    });
    return index;
}

function globalShowLayerBySrc(src, width) {

}
function globalShowLayerTab(list, width) {
    layer.tab({
        area: ['600px', '300px'],
        tab: [{
                title: 'TAB1',
                content: '内容1'
            }, {
                title: 'TAB2',
                content: '内容2'
            }, {
                title: 'TAB3',
                content: '内容3'
            }]
    });
}

function globalGetRequest() {
    var url = location.search; //获取url中"?"符后的字串 
    var theRequest = new Object();
    if (url.indexOf("?") != -1) {
        var str = url.substr(1);
        strs = str.split("&");
        for (var i = 0; i < strs.length; i++) {
            theRequest[strs[i].split("=")[0]] = unescape(strs[i].split("=")[1]);
        }
    }
    return theRequest;
}

function globalSelectAllCheckBox(checkBoxList) {
    for (var i = 0; i < checkBoxList.length; i++) {
        var checkBox = checkBoxList[i];
        checkBox.checked = true;
    }
}
function globalAlert(msg) {
    layer.msg(msg);
}

function globalURLParameterize(list, key) {

    var string = '';

    for (var i = 0; i < list.length; i++) {
        if (i === 0) {
            string += key + '=' + list[i];
        } else {
            string += '&' + key + '=' + list[i];
        }
    }
    return string;
}

var global = new Object();

global.alert = function (msg) {
    if(typeof Native != 'undefined'){
        Native.alert(msg);
    }else{
        alert(msg);
    }

};
global.msg = function (msg) {
    layer.msg(msg);
};
global.startLoading = function () {
    if (this.isLoading) {
        return;
    }
    this.loadingView = $('<div class="spinner"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div>');

    $("body").append(this.loadingView);

    var top = ($(window).height() - $(this.loadingView).height()) / 2;
    var left = ($(window).width() - $(this.loadingView).width()) / 2;
    var scrollTop = $(document).scrollTop();
    var scrollLeft = $(document).scrollLeft();
    $(this.loadingView).css({position: 'absolute', 'top': top + scrollTop, left: left + scrollLeft}).show();

    this.isLoading = true;
};
global.stopLoading = function () {
    if(this.isLoading){
        this.loadingView.remove();
        this.isLoading = false;
    }
};
global.getRequest = function () {

    var url = location.search; //获取url中"?"符后的字串 
    var theRequest = new Object();
    if (url.indexOf("?") != -1) {
        var str = url.substr(1);
        strs = str.split("&");
        for (var i = 0; i < strs.length; i++) {
            theRequest[strs[i].split("=")[0]] = unescape(strs[i].split("=")[1]);
        }
    }
    return theRequest;
};
global.showTip = function ($target, position, url) {
    $target.click(function () {
        global.hideTip($(this));
    });
    $target = $target.css(position).show();
    if (url != null) {
        $target.load(url);
    }
};

global.hideTip = function ($target) {
    $target.hide();
};

global.tipPosition = function ($sender, alignX, alignY, distX, distY, width, height) {
    $offset = $sender.offset();
    var top = $offset.top;
    var left = $offset.left;

    var senderWidth = $sender.width();
    var senderHeight = $sender.height();

    if (alignX == 'left') {
        left += distX;
    } else {
        left = left + senderWidth - width - distX;
    }

    if (alignY == 'top') {
        top += distY;
    } else {
        top = top + senderHeight - height - distY;
    }

    return {
        top: top,
        left: left,
    }

};

global.submitJson = function(formId, url, callback){

    if(!confirm('确认？')){
        return false;
    }

    var form = $("#" + formId);

    var method = form.attr('method');

    var data = form.serialize();

    global.startLoading();
    $.ajax({
        url: url,
        type: method,
        dataType: 'json',
        data: data,
        context: document.body,
        success: function (json) {
            if (json.code != 200) {
                global.msg(json.msg);
            }else{
                if(callback != null){
                    callback(json);
                }else{
                    global.msg(json.msg);
                }

                return json;
            }
        },
        complete: function () {
            global.stopLoading();
        },
        error: function() {
            global.msg('失败');
        }
    });

};
global.layerImage = function(sender, width){

    var src = sender.src;

    if(src == ''){
        return;
    }

    global.imageSrc(src,width);

};
global.imageSrc = function(src, width){
    var img = $("<img style='width:100%' src='" + src + "'/>");

    if(typeof(Native) != "undefined"){
        Native.image(src);
        return;
    }

    global.startLoading();
    img.on('load', function () {
        global.stopLoading();
        layer.open({
            type: 1,
            title: false,
            closeBtn: 1,
            area: width,
            skin: 'layui-layer-nobg', //没有背景色
            shadeClose: true,
            content: "<img style='width:100%' src='" + src + "'/>"
        });
    });

};
global.orientation = function (file, callback){

    EXIF.getData(file, function() {
        EXIF.getAllTags(this);
        var result =  EXIF.getTag(this, 'Orientation');

        callback(file, result);
    });

};
global.compress = function (file, orientation, callback){


    var reader = new FileReader();

    reader.onload = function (e) {

        var image = $('<img/>');
        image.on('load', function () {
            var width = 1024;
            var height = width * this.height / this.width;
            var canvas = document.createElement('canvas');

            canvas.width = width;
            canvas.height = height;

            var context = canvas.getContext('2d');
            context.clearRect(0, 0, width, height);
            var imageWidth;
            var imageHeight;
            var offsetX = 0;
            var offsetY = 0;

            // context.drawImage(this, 0, 0, width, height);

            if(orientation != null && orientation != "" && orientation != 1) {

                switch (orientation) {
                    case 6://需要顺时针（向左）90度旋转
                        global.rotateImg(this, 'left', canvas);
                        break;
                    case 8://需要逆时针（向右）90度旋转
                        global.rotateImg(this, 'right', canvas);
                        break;
                    case 3://需要180度旋转  ;
                        global.rotateImg(this, 'right', canvas);//转两次
                        global.rotateImg(this, 'right', canvas);
                        break;
                }
            }else{
                context.drawImage(this, 0, 0, width, height);
            }


            var data = canvas.toDataURL('image/jpeg');
            callback(data);
        });

        image.attr('src', e.target.result);
    };

    reader.readAsDataURL(file);
};

global.rotateImg = function (img, direction,canvas) {
    //alert(img);
    //最小与最大旋转方向，图片旋转4次后回到原方向
    var min_step = 0;
    var max_step = 3;
    //var img = document.getElementById(pid);
    if (img == null)return;
    //img的高度和宽度不能在img元素隐藏后获取，否则会出错
    var height = img.height;
    var width = img.width;
    //var step = img.getAttribute('step');
    var step = 2;
    if (step == null) {
        step = min_step;
    }
    if (direction == 'right') {
        step++;
        //旋转到原位置，即超过最大值
        step > max_step && (step = min_step);
    } else {
        step--;
        step < min_step && (step = max_step);
    }
    //img.setAttribute('step', step);
    /*var canvas = document.getElementById('pic_' + pid);
     if (canvas == null) {
     img.style.display = 'none';
     canvas = document.createElement('canvas');
     canvas.setAttribute('id', 'pic_' + pid);
     img.parentNode.appendChild(canvas);
     }  */
    //旋转角度以弧度值为参数
    var degree = step * 90 * Math.PI / 180;
    var ctx = canvas.getContext('2d');
    switch (step) {
        case 0:
            canvas.width = width;
            canvas.height = height;
            ctx.drawImage(img, 0, 0);
            break;
        case 1:
            canvas.width = height;
            canvas.height = width;
            ctx.rotate(degree);
            ctx.drawImage(img, 0, -height);
            break;
        case 2:
            canvas.width = width;
            canvas.height = height;
            ctx.rotate(degree);
            ctx.drawImage(img, -width, -height);
            break;
        case 3:
            canvas.width = height;
            canvas.height = width;
            ctx.rotate(degree);
            ctx.drawImage(img, -width, 0);
            break;
    }
};

global.isCanvasSupported = function (){
    var elem = document.createElement('canvas');
    return !!(elem.getContext && elem.getContext('2d'));
};

global.numberFormat = function(number,n, x) {
    var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\.' : '$') + ')';
    return number.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$&,');
};

global.iframe = function (src, width, height) {
    var index = layer.open({
        type: 2,
        title: false,
        closeBtn: 0,
        anim:2,
        area: [width, height],
        // skin: 'layui-layer-nobg', //没有背景色
        content: [src,'no'],

    });
    return index;
};
global.confirm = function (msg, callback, data){
    if(typeof(Native) != "undefined"){
        Native.confirmCallbackData(msg, callback.name, data);
        return;
    }

    var result = confirm(msg);

    if(result){
        callback(data);
    }
};
global.open = function(url){
    if(typeof(Native) != "undefined"){
        Native.open(url);
        return;
    }

    window.open(url);
};

global.push = function(url){
    if(typeof(Native) != "undefined"){
        Native.push(url);
        return;
    }
    if(isMiniProgram()){
        var src = encodeURIComponent(location.origin + location.pathname + '/../' + url);
        // alert(src);
        wx.miniProgram.navigateTo({url:'/pages/index/index?src=' + src});
        return;
    }
    window.location.href= url;
};
global.back = function(){
    history.go(-1);
};
global.groupBy = function(array,callback){
    var grouped = {};

    array.forEach(function(item,index){
        var key = callback(item);

        if(typeof grouped[key] == 'undefined'){
            grouped[key] = [item];
        }else{
            grouped[key].push(item);
        }
    });

    return grouped;

};
global.keyBy = function(array,callback){
    var grouped = {};

    array.forEach(function(item,index){
        var key = callback(item);

        if(typeof grouped[key] == 'undefined'){
            grouped[key] = item;
        }
    });

    return grouped;
};
global.map = function(array,callback){
    var mapped = [];

    array.forEach(function(item,index){
        var object = callback(item);

        mapped.push(object);
    });

    return mapped;
};
global.empty = function(value){
    return value == null || value == '' || value == 0 || value == -1 || value == 'false';
};
function isWechat(){
    var ua = navigator.userAgent.toLowerCase();
    if(ua.match(/MicroMessenger/i)=="micromessenger") {
        return true;
    } else {
        return false;
    }
}

function isMiniProgram(){
    return window.__wxjs_environment === 'miniprogram';
}

global.isValidPhone = function (phone){
    var phonereg = /^((1)\d{10})$/;

    return !phonereg.test(phone) ? false : true;
};

global.isValidPassword = function(password){
    var pwdreg = /^(\w{6,})$/;

    return !pwdreg.test(password) ? false : true;
};

Date.prototype.addDays = function(days){
    var time = this.getTime() + 86400000 * days;

    return new Date(time);
};

Date.prototype.format = function(fmt)
{ //author: meizz
    var o = {
        "M+" : this.getMonth()+1,                 //月份
        "d+" : this.getDate(),                    //日
        "h+" : this.getHours(),                   //小时
        "m+" : this.getMinutes(),                 //分
        "s+" : this.getSeconds(),                 //秒
        "q+" : Math.floor((this.getMonth()+3)/3), //季度
        "S"  : this.getMilliseconds()             //毫秒
    };
    if(/(y+)/.test(fmt))
        fmt=fmt.replace(RegExp.$1, (this.getFullYear()+"").substr(4 - RegExp.$1.length));
    for(var k in o)
        if(new RegExp("("+ k +")").test(fmt))
            fmt = fmt.replace(RegExp.$1, (RegExp.$1.length==1) ? (o[k]) : (("00"+ o[k]).substr((""+ o[k]).length)));
    return fmt;
};