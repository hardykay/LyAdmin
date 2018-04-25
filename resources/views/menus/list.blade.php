@extends('layouts.main')

@section('title', '栏目管理')

@section('style')
    <style>
        .layui-table th{
            text-align: center;
        }
        .layui-table .td-center{
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
            <a href="{{ route('menus/add/page') }}" class="layui-btn layui-btn-normal">添加栏目</a>
            @foreach($top_menus as $top_menu)
                <a href="{{ route('menus/list',['id'=>$top_menu->id]) }}" class="layui-btn @if($id==$top_menu->id) layui-btn-disabled @endif">{{ $top_menu->title }}</a>
            @endforeach
        </div>
    </fieldset>
</div>

<div class="layui-row">
    <div class="layui-form">
        <table class="layui-table">
            <colgroup>
                <col width="300">
                <col>
                <col width="130">
                <col width="210">
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
                    <td class="td-center">{{ $son_menu->title }}</td>
                    <td>{{ $son_menu->sons }}</td>
                    <td class="td-center">{{ $son_menu->sort }}</td>
                    <td class="td-center">
                        <div class="layui-btn-group">
                            <a href="{{ route('menus/add/page',['id'=>$son_menu->id]) }}" class="layui-btn layui-btn-sm layui-btn-normal">添加子操作</a>
                            <a href="" class="layui-btn layui-btn-sm">编辑</a>
                            <button class="layui-btn layui-btn-sm layui-btn-danger delthis">删除</button>
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


        $('.delthis').click(function () {
            layer.confirm('确定要删除该栏目吗？',function () {
                var token='{{ csrf_token() }}';
                lyajax.lyajax('{{ route('menus/del',['id'=>'1']) }}','delete',{_token:token},function (res) {
                    layer.msg('删除成功!',{icon:1,time:1000},function () {
                        window.location.reload();
                    });
                });
            });
        });

    });
</script>
@endsection