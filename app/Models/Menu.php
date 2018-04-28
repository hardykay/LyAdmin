<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    /**
     * 与模型关联的数据表
     *
     * @var string
     */
    protected $table = 'menus';

    /**
     * 主键
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * 该模型是否被自动维护时间戳
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * 获取子级栏目
     * @param $parent_id
     * @return \Illuminate\Support\Collection
     */
    public function getSons($parent_id)
    {
        return $this->where('parent_id',$parent_id)->orderBy('sort','desc')->orderBy('id','asc')->get();
    }

    /**
     * 获取子级操作
     * @param $parent_id
     * @return \Illuminate\Support\Collection
     */
    public function getDoSons($parent_id)
    {
        return $this->where('parent_id',$parent_id)->where('href','<>','')->orderBy('sort','desc')->orderBy('id','asc')->get();
    }

    /**
     * 添加栏目
     * @param $data
     * @return bool
     */
    public function addData($data)
    {
        return $this->insert($data);
    }

    /**
     * 编辑栏目
     * @param $id
     * @param $data
     * @return bool
     */
    public function upData($id,$data)
    {
        return $this->where('id',$id)->update($data);
    }
}
