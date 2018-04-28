@extends('layouts.main')

@section('title', '栏目管理')

@section('style')
    <style>
        .layui-table th{
            text-align: center;
        }
        .layui-table td{
            text-align: center;
        }
    </style>
@endsection

@section('content')
<div class="layui-row">
    <blockquote class="layui-elem-quote">
        <span class="layui-breadcrumb">
          <a href="javascript:;">首页</a>
          <a href="javascript:;">栏目管理</a>
          <a><cite>栏目列表</cite></a>
        </span>
    </blockquote>
</div>

<div class="layui-row">
    <fieldset class="layui-elem-field">
        <legend>顶级栏目</legend>
        <div class="layui-field-box">
            <a href="{{ route('menus.add.page') }}" class="layui-btn layui-btn-normal">添加栏目</a>
            @foreach($top_menus as $top_menu)
                @if($id==$top_menu->id)
                    <span class="layui-btn layui-btn-warm tips-this" value_id="{{ $top_menu->id }}">{{ $top_menu->title }}<i class="layui-icon">&#xe614;</i></span>
                @else
                    <a href="{{ route('menus.list',['id'=>$top_menu->id]) }}" class="layui-btn">{{ $top_menu->title }}</a>
                @endif
            @endforeach
        </div>
    </fieldset>
</div>

<div class="layui-row">
    <div class="layui-form">
        <table class="layui-table">
            <colgroup>
                <col width="400">
                <col>
                <col width="150">
                <col width="250">
            </colgroup>
            <thead>
            <tr>
                <th>栏目标题</th>
                <th>子操作</th>
                <th>排序</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($son_menus as $son_menu)
                <tr>
                    <td>{{ $son_menu->title }}</td>
                    <td>
                    @foreach($son_menu->sons as $son)
                        <a href="{{ route('menus.edit.page',['id'=>$son->id]) }}" style="color: #01AAED;">{{ $son->title }}</a>
                    @endforeach
                    </td>
                    <td>{{ $son_menu->sort }}</td>
                    <td>
                        <div class="layui-btn-group">
                            <a href="{{ route('menus.add.page',['id'=>$son_menu->id]) }}" class="layui-btn layui-btn-sm layui-btn-normal">添加子操作</a>
                            <a href="{{ route('menus.edit.page',['id'=>$son_menu->id]) }}" class="layui-btn layui-btn-sm">编辑</a>
                            <span class="layui-btn layui-btn-sm layui-btn-danger del-this" value_id="{{ $son_menu->id }}">删除</span>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('script')
<script>
    layui.use(['layer','lyajax'], function(){
        var layer = layui.layer;
        var lyajax = layui.lyajax;
        var $ = layui.$;

        $('.tips-this').on('click', function(){
            var value_id=$(this).attr('value_id');
            var edit_url="{{ route('menus.edit.page') }}";
            var alert_tips='<a href="'+edit_url+'/'+value_id+'" class="layui-btn layui-btn-sm layui-btn-normal">编辑</a><span class="layui-btn layui-btn-sm layui-btn-danger del-this" value_id="'+value_id+'">删除</span>';
            layer.tips(alert_tips, this,{tips: 3});
        });

        $('body').on('click','.del-this',function () {
            var value_id=$(this).attr('value_id');
            layer.confirm('确定要删除该栏目及其下属栏目吗？',function () {
                var token='{{ csrf_token() }}';
                lyajax.lyajax('{{ route('menus.del') }}','delete',{_token:token,id:value_id},function (res) {
                    layer.msg('删除成功!',{icon:1,time:1000},function () {
                        window.location.reload();
                    });
                });
            });
        });
    });
</script>
@endsection