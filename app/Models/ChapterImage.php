<?php
/**
 * Created by PhpStorm.
 * User: xieyu
 * Date: 2018/11/16
 * Time: 17:55
 */
namespace App\Models;

class ChapterImage extends Model
{
    public $table = 'chapter_image';

    /**
     * 根据排序值排序.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $sort
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSortrank($query)
    {
        return $query->orderBy('sortrank','ASC');
    }

}