<?php
/**
 * Created by PhpStorm.
 * User: xieyu
 * Date: 2018/11/15
 * Time: 17:56
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model as IlluminateModel;

class Model extends IlluminateModel
{
    /**
     * 公共排序
     *
     * @param  [type] $query [description]
     * @return [type]        [description]
     */
    public function scopeSort($query)
    {
        return $query->orderBy('order_num', 'DESC');
    }

    /**
     * 公共启用.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeStatus($query)
    {
        return $query->where('status', 1);
    }

}