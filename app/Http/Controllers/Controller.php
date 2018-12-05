<?php

namespace App\Http\Controllers;

use Dingo\Api\Routing\Helpers;
use Dingo\Api\Exception\StoreResourceFailedException;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

/**
 * @SWG\Swagger(
 *     @OA\Info(title="Wxapp接口说明文档", version="0.1")
 * )
 */
class Controller extends BaseController
{
    use Helpers;

    /**
     * Throw the failed validation exception.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Dingo\Api\Exception\StoreResourceFailedException
     */
    protected function throwValidationException(Request $request, $validator)
    {
        throw new StoreResourceFailedException('Validation Error', $validator->errors());
    }
}

