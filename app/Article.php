<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

class Article extends Model
{
    use SoftDeletes, SoftCascadeTrait;
    protected $softCascade = ['tag'];
    public function tag()
    {
        return $this->hasMany('App\Tag');
    }
    public function author()
    {
        return $this->belongsTo('App\Author');
    }
    public static function insertArticle($request){
        // $parameters = $request->only(
        //     // 'author_id',
        //     // 'cover_img',
        //     // 'title',
        //     // 'byline',
        //     // 'place',
        //     // 'tags',
        //     // 'read_time',
        //     // 'content',
        //     // 'content_img',
        //     // 'hero_article',
        //     // 'secondary_article',
        //     // 'approved'
		// 	);

        $article = new Article();
        foreach ($request as $key => $value) {
            $article->{$key} = $value;
		}

        $article->save();
        return $article;
	}

    public static function updateArticle($request, $id){
        // $parameters = $request->only(
        //     'author_id',
        //     'cover_img',
        //     'title',
        //     'byline',
        //     'place',
        //     'tags',
        //     'read_time',
        //     'content',
        //     'content_img',
        //     'hero_article',
        //     'secondary_article',
        //     'approved');
        $article = Article::find($id);
        foreach ($request as $key => $value) {
            $article->{$key} = $value;
		}

        $article->save();
        return $article;
    }

}
