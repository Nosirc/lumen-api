<?php
namespace App\Http\Requests\Wxapp;

use App\Http\Requests\FormRequest;

class IndexRequest extends FormRequest
{
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
            case 'PUT':
            case 'PATCH':
            case 'GET':
            {
                if($this->segment(3) == 'movies'){
                    return [
                        'form'   =>  'numeric',
                        'limit'  =>  'numeric',
                        'page'   =>  'numeric',
                    ];
                } elseif ($this->segment(3) == 'chapter'){
                    return [
                        'movies_id'   =>  'required|numeric',
                        'sort'        =>  'string',
                    ];
                } elseif ($this->segment(3) == 'chapter-images'){
                    return [
                        'chapter_id'   =>  'required|numeric',
                    ];
                } elseif ($this->segment(3) == 'movies-info'){
                    return [
                        'movies_id'   =>  'required|numeric',
                    ];
                }
                return [];
            }
            case 'DELETE':
            default:
                {
                    return [];
                }
        }
    }

    public function messages()
    {
        return [
            //'form.numeric'  => '分类必须为数字',
        ];
    }
}