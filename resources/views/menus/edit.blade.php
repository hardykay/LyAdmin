@extends('layouts.main')

@section('title', '编辑 - '.$menu->title)

@section('content')
    <div class="layui-row">
        <blockquote class="layui-elem-quote">
            <span class="layui-breadcrumb">
              <a href="javascript:;">首页</a>
              <a href="javascript:;">栏目管理</a>
              <a><cite>编辑 - {{ $menu->title }}</cite></a>
            </span>
        </blockquote>
    </div>

    <div class="layui-row">
        <form class="layui-form layui-form-pane" action="{{ route('menus.edit.do') }}" method="post">
            <div class="layui-form-item">
                <label class="layui-form-label"> 名称 </label>
                <div class="layui-input-block">
                    <input type="text" name="title" required lay-verify="required" placeholder="请输入名称"
                           value="{{ $menu->title }}" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label"> 地址 </label>
                <div class="layui-input-block">
                    <input type="text" name="href" placeholder="请输入地址 p.s. 多个操作地址以英文半角逗号`,`分隔" value="{{ $menu->href }}"
                           autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label"> 父级栏目 </label>
                <div class="layui-input-block">
                    <select name="parent_id">
                        <option value="0">顶级栏目</option>
                        @foreach($top_menus as $top_menu)
                            <optgroup label="{{ $top_menu->title }}">
                                <option value="{{ $top_menu->id }}" @if($top_menu->id==$menu->parent_id) selected @endif>{{ $top_menu->title }}</option>
                                @foreach($top_menu->sons as $son_menu)
                                    <option value="{{ $son_menu->id }}" @if($son_menu->id==$menu->parent_id) selected @endif>&nbsp;&nbsp;{{ $son_menu->title }}</option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label"> 排序 </label>
                <div class="layui-input-block">
                    <input type="number" name="sort" value="{{ $menu->sort }}" placeholder="排序 默认为1000 数字大的在前面"
                           autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    <input type="hidden" name="id" value="{{ $id }}">
                    <button class="layui-btn" lay-submit lay-filter="formSubmit">立即提交</button>
                    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script>
        layui.use('form', function () {
            var form = layui.form;
        });
    </script>
@endsection