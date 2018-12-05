<?php
/**
 * Created by PhpStorm.
 * User: xieyu
 * Date: 2018/11/15
 * Time: 10:57
 */

namespace App\Models;

class Movies extends Model
{
    const CREATED_AT   = 'add_time';
    const UPDATED_AT   = 'lastupdate';

    /**
     * 模型中日期字段的存储格式
     *
     * @var string
     */
    protected $dateFormat = 'U';

    /**
     * 执行模型是否自动维护时间戳.
     *
     * @var bool
     */
    //public $timestamps = false;

    /**
     * 应该被转换成原生类型的属性。
     *
     * @var array
     */
    protected $casts = [
        'add_time'      => 'datetime:Y-m-d H:i:s',
    ];

    /**
     * 格式化修改时间。
     *
     * @param  integer  $value
     * @return string
     */
    public function getLastupdateAttribute($value)
    {
        return $value?date('Y-m-d H:i:s',$value):'';
    }

    /**
     * 格式化上线时间。
     *
     * @param  integer  $value
     * @return string
     */
    public function getOnlineTimeAttribute($value)
    {
        return $value?date('Y-m-d H:i:s',$value):'';
    }

    /**
     * 格式化推广时间。
     *
     * @param  integer  $value
     * @return string
     */
    public function getExpandTimeAttribute($value)
    {
        return $value?date('Y-m-d H:i:s',$value):'';
    }

    /**
     * 格式化完结时间。
     *
     * @param  integer  $value
     * @return string
     */
    public function getOverdateAttribute($value)
    {
        return $value?date('Y-m-d H:i:s',$value):0;
    }


    /**
     * 根据渠道等级筛选影片.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $rank
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfRank($query, $rank)
    {
        return $query->where('rank', '<=', $rank);
    }
}