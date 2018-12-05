<?php

namespace App\Listeners;

use Dingo\Api\Event\ResponseIsMorphing;

class FormatToResponse
{
    public function handle(ResponseIsMorphing  $event)
    {
        $content = $event->content;

        $swagger = false;
        if(is_string($content) && !is_null(json_decode($content)) && !empty(json_decode($content)->openapi)){
            $swagger = true;
        }

        $format = $content;
        if(!($content instanceof \Illuminate\View\View) && !$swagger){
            if ( $event->response->status() == 200 ) {
                $format = [
                    'status_code' => 200,
                    'data'        => $content?:[],
                    'message'     => 'ok'
                ];
            } elseif ( is_string($content) ) {
                $format = [
                    'status_code' => $event->response->status(),
                    'data'        => [],
                    'message'     => $content
                ];
            } elseif (!empty($content['errors'])) {
                $format = [
                    'status_code' => $content['status_code'],
                    'data'        => [],
                    'message'     => array_reduce($content['errors'],function($res,$v){
                                        return $res.current($v).',';
                                    })
                ];
            }
        }

        if (isset($format['status_code'])) {
            $event->response->statusCode($format['status_code']);
        }

        $event->content = $format;
    }
}