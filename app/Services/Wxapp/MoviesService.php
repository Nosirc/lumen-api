<?php
/**
 * Created by PhpStorm.
 * User: xieyu
 * Date: 2018/11/15
 * Time: 9:53
 */
namespace App\Services\Wxapp;

use App\Models\Movies;
use App\Models\Form;
use App\Models\Chapter;
use App\Models\ChapterImage;

class MoviesService
{
    private $model;
    private $rank;

    public function __construct(Movies $movies)
    {
        $this->model = $movies;
        $this->rank  = config('app.moviesRank');
    }

    /**
     * 电影分类列表
     */
    public function getFormList()
    {
        return Form::all();
    }

    /**
     * 小编精选
     */
    public function getEditorFeatured()
    {
        return $this->model->status()->ofRank($this->rank)->sort()->take(4)->get();
    }

    /**
     * 影片列表
     */
    public function getMoviesList($form, $limit)
    {
        $query = $this->model->status()->ofRank($this->rank);
        if($form){
            $query->where('form', 'like', '%'.$form.'%');
        }
        return $query->sort()->paginate($limit);
    }

    /**
     * 影片章节列表
     */
    public function getChapterList($movies_id, $sort)
    {
        return Chapter::where('movies_id',$movies_id)->status()->ofSortrank($sort)->get();
    }

    /**
     * 影片详情
     */
    public function getMoviesInfo($movies_id)
    {
        $info = $this->model->status()->findOrFail($movies_id);
        $info->form = ($form = json_decode($info->form,true)) ? Form::whereIn('id',$form)->pluck('name') : [];
        return $info;
    }

    /**
     * 章节图片
     */
    public function getChapterImages($chapter_id)
    {
        $chapter = Chapter::where('id',$chapter_id)->with('movies:id,begin_pay,name')->first();

        $status = $chapter->sortrank < $chapter->movies->begin_pay ? 1 : 2;//是否付费
        //$status = 1;//暂时开放
        $text   = '';
        $images = [];
        if($status == 2 ){
            $text = '关注“猎奇影库”公众号，回复“'.$chapter->movies->name.'”即可观看。';
        }else{
            $images = ChapterImage::where('chapter_id',$chapter_id)->status()->sortrank()->get();
        }

        $next_chapter_id = Chapter::where(['sortrank' => ($chapter->sortrank + 1),'movies_id' => $chapter->movies_id])->pluck('id')->first()?:0;
        $prev_chapter_id = Chapter::where(['sortrank' => ($chapter->sortrank - 1),'movies_id' => $chapter->movies_id])->pluck('id')->first()?:0;


        return [
            'status'          => $status,
            'text'            => $text,
            'prev_chapter_id' => $prev_chapter_id,
            'next_chapter_id' => $next_chapter_id,
            'images'          => $images
        ];
    }

}