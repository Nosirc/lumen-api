<?php
/**
 * Created by PhpStorm.
 * User: xieyu
 * Date: 2018/11/15
 * Time: 17:30
 */
namespace App\Services\Wxapp;

use App\Models\Advertisement;

class AdvertisementService
{
    private $model;

    public function __construct(Advertisement $advertisement)
    {
        $this->model = $advertisement;
    }

    /**
     * Banner列表。
     */
    public static function getAdvertisementList()
    {
        return Advertisement::where(['adv_position_id'=>15])->status()->sort()->get();
    }

}