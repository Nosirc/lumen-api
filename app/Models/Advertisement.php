<?php
/**
 * Created by PhpStorm.
 * User: xieyu
 * Date: 2018/11/15
 * Time: 17:26
 */
namespace App\Models;

class Advertisement extends Model
{
    public $table = 'advertisement';

    /**
     * 应该被转换成原生类型的属性。
     *
     * @var array
     */
    protected $casts = [
        'create_time'      => 'datetime:Y-m-d H:i:s',
    ];

}