<?php
/**
 * Created by PhpStorm.
 * User: Nosirc
 * Date: 2019/4/2
 * Time: 17:45
 */
namespace App\Http\Middleware;

use Closure;

class ResponseMiddleware
{
    /**
     * 统一返回响应.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        if($request->segment(2) == 'app'){
            return response()->json(self::appResponse($response));
        }elseif($request->segment(2) == 'wxapp'){
            return response()->json(self::wxappResponse($response));
        }

        return $response;
    }

    /**
     * app
     */
    private function appResponse($response)
    {
        $content = $response->original;

        if ($response->getStatusCode() != 200) {
            $format = [
                'status_code' => $response->getStatusCode(),
                'data'        => (object)null,
                'message'     => config('app.debug') ? $content : '系统错误'
            ];
        } elseif (!empty($content['status_code']) && $content['status_code'] != 200) {
            $format = [
                'status_code' => $content['status_code'],
                'data'        => (object)null,
                'message'     => (config('app.debug') && !empty($content['message'])) ? $content['message'] : trans('api.' . $content['status_code'])
            ];
            !empty($content['trace']) && $format['trace'] = $content['trace'];
        } else {

            if(is_null($content)){
                $content = (object)null;
            }else{
                $content = $content ? urlencode(json_encode($content)) : $content;
            }

            $format = [
                'status_code' => 200,
                'data'        => $content,
                'message'     => 'SUCCESS'
            ];
        }

        return $format;
    }

    /**
     * 小程序
     */
    private function wxappResponse($response)
    {
        $content = $response->original;

        if ($response->getStatusCode() != 200) {
            $format = [
                'status_code' => $response->getStatusCode(),
                'data'        => (object)null,
                'message'     => config('app.debug') ? $content : '系统错误'
            ];
        } elseif (!empty($content['status_code']) && $content['status_code'] != 200) {
            $format = [
                'status_code' => $content['status_code'],
                'data'        => (object)null,
                'message'     => (config('app.debug') && !empty($content['message'])) ? $content['message'] : trans('api.' . $content['status_code'])
            ];
            !empty($content['trace']) && $format['trace'] = $content['trace'];
        } else {
            $format = [
                'status_code' => 200,
                'data'        => $content,
                'message'     => 'ok'
            ];
        }

        return $format;
    }
}