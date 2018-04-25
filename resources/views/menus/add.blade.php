@extends('layouts.main')

@section('title', $title)

@section('content')
    <div class="layui-row">
        <blockquote class="layui-elem-quote">
            <span class="layui-breadcrumb">
              <a href="javascript:;">首页</a>
              <a href="javascript:;">栏目管理</a>
              <a><cite>{{ $title }}</cite></a>
            </span>
        </blockquote>
    </div>

    <div class="layui-row">
        <form class="layui-form layui-form-pane" action="{{ route('menus/add/do') }}" method="post">
            <div class="layui-form-item">
                <label class="layui-form-label">@if(empty($id)) 栏目名称 @else 操作名称 @endif</label>
                <div class="layui-input-block">
                    <input type="text" name="title" required  lay-verify="required" placeholder="请输入栏目名称" autocomplete="off" class="layui-input">
                </div>
            </div>
            @if(!empty($id))
            <div class="layui-form-item">
                <label class="layui-form-label"> 地址 </label>
                <div class="layui-input-block">
                    <input type="hidden" name="iddo" value="1">
                    <input type="text" name="href" required  lay-verify="required" placeholder="请输入操作地址" autocomplete="off" class="layui-input">
                </div>
            </div>
            @endif
            <div class="layui-form-item">
                <label class="layui-form-label"> 父级栏目 </label>
                <div class="layui-input-block">
                    <select name="parent_id" lay-verify="required">
                        @if($menu)
                            <option value="{{ $menu->id }}">{{ $menu->title }}</option>
                        @else
                            <option value="0">顶级栏目</option>
                            @foreach($top_menus as $top_menu)
                                <option value="{{ $top_menu->id }}">{{ $top_menu->title }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label"> 排序 </label>
                <div class="layui-input-block">
                    <input type="number" name="sort" value="1000" placeholder="排序 默认为1000 数字大的在前面" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    {{ csrf_field() }}
                    <button class="layui-btn" lay-submit lay-filter="formSubmit">立即提交</button>
                    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script>
        layui.use('form', function(){
            var form = layui.form;
        });
    </script>
@endsection