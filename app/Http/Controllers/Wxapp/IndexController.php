<?php
/**
 * Created by PhpStorm.
 * User: xieyu
 * Date: 2018/11/14
 * Time: 11:54
 */

namespace App\Http\Controllers\Wxapp;

use App\Http\Controllers\Controller;
use App\Http\Requests\Wxapp\IndexRequest as Request;
use App\Services\Wxapp\MoviesService;
use App\Services\Wxapp\AdvertisementService;

class IndexController extends Controller
{
    public $moviesService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(MoviesService $moviesService)
    {
        $this->moviesService = $moviesService;
    }

    /**
     * @OA\Get(
     *     path="/api/wxapp/index",
     *     tags={"小程序"},
     *     summary="首页",
     *     description="首页",
     *     operationId="首页",
     *     deprecated=false,
     *     @OA\Response(
     *         response=200,
     *         description="操作成功返回"
     *     )
     * )
     */
    public function index()
    {
        return [
            'banner'    => AdvertisementService::getAdvertisementList(),
            'form'      => $this->moviesService->getFormList(),
            'featured'  => $this->moviesService->getEditorFeatured()
        ];
    }

    /**
     * @OA\Get(
     *     path="/api/wxapp/forms",
     *     tags={"小程序"},
     *     summary="分类列表",
     *     description="分类列表",
     *     operationId="分类列表",
     *     deprecated=false,
     *     @OA\Response(
     *         response=200,
     *         description="操作成功返回"
     *     )
     * )
     */
    public function getFormList()
    {
        return $this->moviesService->getFormList();
    }

    /**
     * @OA\Get(
     *     path="/api/wxapp/movies",
     *     tags={"小程序"},
     *     summary="影片列表",
     *     description="影片列表",
     *     operationId="影片列表",
     *     deprecated=false,
     *     @OA\Parameter(
     *         name="form",
     *         in="query",
     *         description="分类",
     *         required=false,
     *         @OA\Schema(
     *             type="numeric"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="limit",
     *         in="query",
     *         description="显示条数",
     *         required=false,
     *         @OA\Schema(
     *             type="numeric"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="页码",
     *         required=false,
     *         @OA\Schema(
     *             type="numeric"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="操作成功返回"
     *     )
     * )
     */
    public function getMoviesList(Request $request)
    {
        $form  = $request->get('form');
        $limit = $request->get('limit',20);

        return $this->moviesService->getMoviesList($form, $limit);
    }

    /**
     * @OA\Get(
     *     path="/api/wxapp/chapter",
     *     tags={"小程序"},
     *     summary="影片章节列表",
     *     description="影片章节列表",
     *     operationId="影片章节列表",
     *     deprecated=false,
     *     @OA\Parameter(
     *         name="movies_id",
     *         in="query",
     *         description="电影id",
     *         required=false,
     *         @OA\Schema(
     *             type="numeric"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="sort",
     *         in="query",
     *         description="排序(ASC,DESC)",
     *         required=false,
     *         @OA\Schema(
     *             type="numeric"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="操作成功返回"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="发生错误"
     *     )
     * )
     */
    public function getChapterList(Request $request)
    {
        $movies_id = $request->get('movies_id');
        $sort      = $request->get('sort','ASC');

        return $this->moviesService->getChapterList($movies_id, $sort);
    }

    /**
     * @OA\Get(
     *     path="/api/wxapp/movies-info",
     *     tags={"小程序"},
     *     summary="影片详情",
     *     description="影片详情",
     *     operationId="影片详情",
     *     deprecated=false,
     *     @OA\Parameter(
     *         name="movies_id",
     *         in="query",
     *         description="电影id",
     *         required=false,
     *         @OA\Schema(
     *             type="numeric"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="操作成功返回"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="发生错误"
     *     )
     * )
     */
    public function getMoviesInfo(Request $request)
    {
        $movies_id = $request->get('movies_id');

        return $this->moviesService->getMoviesInfo($movies_id);
    }


    /**
     * @OA\Get(
     *     path="/api/wxapp/chapter-images",
     *     tags={"小程序"},
     *     summary="章节图片",
     *     description="章节图片",
     *     operationId="章节图片",
     *     deprecated=false,
     *     @OA\Parameter(
     *         name="chapter_id",
     *         in="query",
     *         description="章节id",
     *         required=false,
     *         @OA\Schema(
     *             type="numeric"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="操作成功返回"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="发生错误"
     *     )
     * )
     */
    public function getChapterImages(Request $request)
    {
        $chapter_id = $request->get('chapter_id');

        return $this->moviesService->getChapterImages($chapter_id);
    }
}