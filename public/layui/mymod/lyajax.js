layui.define('layer',function(exports){
    var $=layui.$;
    var obj = {
        lyajax: function(url,type,data,success){
            url=url || '';
            type=type || 'get';
            data=data || {};
            $.ajax({
                url:url,
                type:type,
                data:data,
                dataType:'json',
                success:function (res) {
                    if(typeof success=='function'){
                        success(res);
                    }
                },
                error:function (err) {
                    var status=err.status;
                    if(status==401){
                        window.location.href='/login';
                    }else if(status==419){
                        window.location.reload();
                    }else if(status==422){
                        var errors=err.responseJSON.errors;
                        var alerts=[];
                        $.each(errors,function (i,v) {
                            $.each(v,function (ii,vv) {
                                alerts.push(vv);
                            });
                        });
                        alerts=alerts.join('<br>');
                        layer.alert(alerts);
                    }else{
                        layer.msg('网络错误，请刷新重试!',{icon:2,time:1500});
                    }
                }
            });
        }
    };

    exports('lyajax', obj);
});