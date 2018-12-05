<?php
/**
 * Created by PhpStorm.
 * User: xieyu
 * Date: 2018/11/15
 * Time: 16:27
 */
namespace App\Models;

class Form extends Model
{
    public $table = 'form';

    /**
     * 应该被转换成原生类型的属性。
     *
     * @var array
     */
    protected $casts = [
        'add_time'      => 'datetime:Y-m-d H:i:s',
    ];

}