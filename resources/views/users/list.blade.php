@extends('layouts.main')

@section('title', '用户管理')

@section('content')
    <div class="layui-row">
        <blockquote class="layui-elem-quote">
        <span class="layui-breadcrumb">
          <a href="javascript:;">首页</a>
          <a href="javascript:;">用户管理</a>
          <a><cite>用户列表</cite></a>
        </span>
        </blockquote>
    </div>

    <div class="layui-row">
        <div class="demoTable">
            搜索ID：
            <div class="layui-inline">
                <input class="layui-input" name="id" id="search" autocomplete="off">
            </div>
            <button class="layui-btn" data-type="reload">搜索</button>
        </div>

        <table class="layui-hide" id="layui_table_data" lay-filter="data"></table>
    </div>
@endsection

@section('script')
    <script type="text/html" id="switchStatus">
        <input type="checkbox" name="status" data-id="@{{ d.id }}" lay-skin="switch" lay-text="启用|禁用" lay-filter="statusData" @{{ d.status == 1 ? 'checked' : '' }}>
    </script>
    <script type="text/html" id="toolBar">
        <a class="layui-btn layui-btn-xs" lay-event="detail">查看</a>
        <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
        <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
    </script>
    <script>
        layui.use(['table','lyajax'], function(){
            var table = layui.table;
            var form = layui.form;
            var lyajax = layui.lyajax;
            var $=layui.$;

            //方法级渲染
            table.render({
                elem: '#layui_table_data',
                url: "{{ route('users.list') }}",
                cols: [[
                    {checkbox: true, fixed: true},
                    {field:'id', title: 'ID', width:80,align:'center', sort: true, fixed: true},
                    {field:'username', title: '用户名',align:'center'},
                    {field:'nickname', title: '昵称', width:250,align:'center'},
                    {field:'mobile', title: '手机号', width:150,align:'center'},
                    {field:'email', title: '邮箱',width:200,align:'center'},
                    {field:'status', title:'状态', width:90,align:'center', templet: '#switchStatus', unresize: true},
                    {field:'toolbar', title: '操作',width:200,align:'center',toolbar:'#toolBar'}
                ]],
                id: 'tableReload',
                page: true,
                height: 'full'
            });

            //监听排序
            table.on('sort(data)',function (obj) {
                tableReload(obj,obj.field,obj.type)
            });
            //监听状态操作
            form.on('switch(statusData)', function(obj){
                var id=$(this).attr('data-id');
                var status='';
                var msg='';
                if(obj.elem.checked){
                    status='1';
                    msg='启用';
                }else{
                    status='0';
                    msg='禁用';
                }
                var token='{{ csrf_token() }}';
                lyajax.lyajax('{{ route('users.edit.do') }}','patch',{_token:token,id:id,status:status},function (res) {
                    if(res.code=='200'){
                        layer.tips('已'+msg+'!', obj.othis,{time:500});
                    }else{
                        layer.tips(msg+'失败，请重试!', obj.othis,{time:1500});
                    }
                });
            });
            //监听工具条
            table.on('tool(data)', function(obj){
                var data = obj.data; //获得当前行数据
                var layEvent = obj.event; //获得 lay-event 对应的值（也可以是表头的 event 参数对应的值）
                var tr = obj.tr; //获得当前行 tr 的DOM对象

                if(layEvent === 'detail'){ //查看
                    //do somehing
                } else if(layEvent === 'del'){ //删除
                    layer.confirm('真的删除行么', function(index){
                        obj.del(); //删除对应行（tr）的DOM结构，并更新缓存
                        layer.close(index);
                        //向服务端发送删除指令
                    });
                } else if(layEvent === 'edit'){ //编辑
                    //do something

                    //同步更新缓存对应的值
                    obj.update({
                        username: '123'
                        ,title: 'xxx'
                    });
                }
            });


            //执行重载
            function tableReload(sortObj,orderField,orderType) {
                var search=$('#search').val();
                table.reload('tableReload', {
                    initSort: sortObj,
                    page: {
                        curr: 1 //重新从第 1 页开始
                    },
                    where: {
                        search: search,
                        orderField:orderField,
                        orderType:orderType
                    }
                });
            }



            $('.demoTable .layui-btn').on('click', function(){
                tableReload();
            });
        });
    </script>
@endsection