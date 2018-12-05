<?php
/**
 * Created by PhpStorm.
 * User: xieyu
 * Date: 2018/11/16
 * Time: 16:58
 */
namespace App\Models;

class Chapter extends Model
{
    public $table = 'chapter';

    /**
     * 根据排序值排序.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $sort
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfSortrank($query, $sort)
    {
        return $query->orderBy('sortrank',$sort);
    }

    /**
     * 获取此章节图片所属电影
     */
    public function movies()
    {
        return $this->belongsTo('App\Models\Movies');
    }

}