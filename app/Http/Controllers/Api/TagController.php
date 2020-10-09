<?php

namespace App\Http\Controllers\Api;

use App\Article;
use App\Author;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tag;

use App\Http\Requests\TagForm;
use App\Http\Resources\TagResource;
use App\User;
use Illuminate\Support\Facades\DB;

class TagController extends Controller
{
    public static function uniqueTags() {
        $tags = Tag::groupBy('name')
            ->selectRaw('count(*) as posts, name')
            ->orderBy('posts','DESC')
            ->get();
        return $tags;
    }

    public static function uniqueTagsCount() {
        $check=Tag::all();
        if($check->isEmpty()){
          return [];
        }
        else{
        $tags = DB::table('tags')->join('articles', 'tags.article_id', '=', 'articles.id')
            ->where('articles.approved' , 1)->where('tags.deleted_at', NULL)
            ->groupBy('tags.name')
            ->selectRaw('count(*) as posts, tags.name as name')
            ->orderBy('posts','DESC')
            ->get();
        $result = json_decode($tags, true);
        return $result;
      }
    }

    public static function postTags($tag) {
        $posts = Tag::where('name',$tag)->groupBy('name')
            ->selectRaw('count(*) as posts, name')
            ->get();
        return $posts;
    }

    public static function postTagsCount($tag) {
        $tags = DB::table('tags')->join('articles', 'tags.article_id', '=', 'articles.id')
            ->where('articles.approved' , 1)
            ->where('tags.name' ,  $tag)->where('tags.deleted_at', NULL)
            ->groupBy('tags.name')
            ->selectRaw('count(*) as posts, tags.name as name')
            ->orderBy('posts','DESC')
            ->get();
        $result = json_decode($tags, true);
        return $result;
    }

    public static function getTagsByArticleId($article_id){
        $tags = Tag::where('article_id',$article_id)->get();
        return $tags;
    }
    public static function getArticleByTag($tag){
        //$tag = $request->tag;
        $articleIds = Tag::where('name',$tag)->pluck('article_id');
        $articles=[];
        foreach($articleIds as $articleId){
            $article = Article::find($articleId);
            if ($article['approved']==1)
            {
              $author=Author::find($article['author_id']);
              $userId=$author['user_id'];
              $article['tags'] = Tag::where('article_id',$article['id'])->pluck('name');
              $user=User::find($userId);
              $article['author']=$user['name'];
              array_push($articles, $article);
            }
        }
        return($articles);
    }
}
