
app.factory('$network',function($http){

    var factory = {};

    factory.get = function(url,successCallback,errorCallback){
        $http({
            url:url,
            method:'GET'

        }).then(
                function(response){successCall(response,successCallback);},
                function(response){errorCall(response,errorCallback);}
            );

    };

    factory.post = function(url,data,successCallback,errorCallback){
        $http({
            url:url,
            method:'POST',
            data : data,
            headers:{'Content-Type': 'application/x-www-form-urlencoded'},
            transformRequest: function(obj) {

                return factory.params(obj);

            }

        }).then(
            function(response){successCall(response,successCallback);},
            function(response){errorCall(response,errorCallback);}
        );

    };
    factory.params = function(obj){
        if(typeof obj == 'string'){
            return obj;
        }

        var str = [];

        for(var p in obj){
            var pv = obj[p];
            if(pv instanceof Array){

                for(var index in pv){
                    var d = pv[index];
                    if(typeof d == 'object'){
                        str.push(encodeURIComponent(p) + "[]=" + encodeURIComponent(JSON.stringify(d)));

                    }else{
                        str.push(encodeURIComponent(p) + "[]=" + encodeURIComponent(d));
                    }

                }

            }else{
                if(pv == null){
                    continue;
                }
                if(typeof pv == 'object'){
                    str.push(encodeURIComponent(p) + "=" + encodeURIComponent(JSON.stringify(pv)));
                }else{
                    str.push(encodeURIComponent(p) + "=" + encodeURIComponent(pv));
                }


            }

        }
        return str.join("&");
    };
    factory.request = function(){

        var url = decodeURIComponent(location.search); //获取url中"?"符后的字串

        if (url.indexOf("?") != -1) {
            var str = url.substr(1);
            return this.query(str);
        }
        return new Object();

    };


    factory.query = function(str){
        var theRequest = new Object();


        strs = str.split("&");
        for(var i = 0; i < strs.length; i ++) {
            var key = strs[i].split("=")[0];
            var value = unescape(strs[i].split("=")[1]);
            if(theRequest.hasOwnProperty(key)){
                var bValue = theRequest[key];
                if(bValue instanceof Array){
                    bValue.push(value);
                }else{
                    var newArray = [bValue,value];
                    theRequest[key]=newArray;
                }
            }else{
                theRequest[key]=value;
            }

        }

        return theRequest;
    };

    function successCall(response,successCallback){
        global.stopLoading();

        if(response.data.code == 300){
            global.alert(response.data.msg);

        }
        successCallback(response.data);
    }

    function errorCall(response,errorCallback){

        global.stopLoading();

        switch (response.status){

            case 500:
                global.alert('出错');
                break;
            default:
                break;
        }

        if(errorCallback != null){
            errorCallback(response);
        }
    }


    return factory;
});
