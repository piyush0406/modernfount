<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Article;
use App\Author;
use App\User;
use App\Tag;
use App\Http\Requests\ArticleForm;
use App\Http\Resources\ArticleCollection;
class ArticleController extends Controller
{
    public static function index() {
        $articles = Article::where('approved',1)->get();
        foreach ($articles as $article) {
            $authorId=$article['author_id'];
            $author=Author::find($authorId);
            $tags = Tag::where('article_id',$article['id'])->get();
            $article['tags'] = $tags;
            $userId=$author['user_id'];
            $user=User::find($userId);
            $article['author']=$user['name'];
        }
        //return new ArticleCollection($articles);
        return($articles);
    }
    public static function unapproveArticle() {
        $articles = Article::where('approved',0)->get();
        foreach ($articles as $article) {
            $authorId=$article['author_id'];
            $author=Author::find($authorId);
            $tags = Tag::where('article_id',$article['id'])->get();
            $article['tags'] = $tags;
            $userId=$author['user_id'];
            $user=User::find($userId);
            $article['author']=$user['name'];
        }
        //return new ArticleCollection($articles);
        return($articles);
    }
    public static function getArticleById($author_id) {
        $articles = Article::where('author_id',$author_id)->where('approved', 1)->get();
        foreach ($articles as $article) {
            $author=Author::find($author_id);
            $userId=$author['user_id'];
            $tags = Tag::where('article_id',$article['id'])->get();
            $article['tags'] = $tags;
            $user=User::find($userId);
            $article['author']=$user['name'];
        }
        //return new ArticleCollection($articles);
        return($articles);
    }

    // public function store(ArticleForm $request) {
    //     $article = Article::insertArticle($request);
    //     return response()->json(['data' => new ArticleCollection($article)], 200);
    // }
    public function store(ArticleForm $request) {
        $userId=$request->user_id;
        $author=Author::where('user_id',$userId)->get();
       // $clean_content = strip_shortcodes( $request->content );
        //$clean_content = strip_tags( $clean_content );
        $word_count = str_word_count( $request->content );
        $time = ceil( $word_count / 250 );


        $articleData=[
            'author_id'=>$author[0]['id'],
            'cover_img'=>$request->cover_img,
            'title'=>$request->title,
            'byline'=>$request->byline,
            'place'=>$request->place,
            'read_time'=>round($time),
            'hero_article'=>$request->hero_article,
            'secondary_article'=>$request->secondary_article,
            'approved'=>$request->approved,
            'content'=>$request->content,
            'content_img'=>$request->content_img
        ];

        $article = Article::insertArticle($articleData);

        $tagstrings = $request->tags;
        $tags=explode(',',$tagstrings);

        $tagData=[
            'article_id'=>$article->id
        ];

        $allTags=[];
        foreach ($tags as $tag){
            $tagData['name']=strtolower($tag);
            $newTag = Tag::insertTag($tagData);
            array_push($allTags, $newTag);
        }

        //return response()->json(['article_data'=>$article,'tags'=>$allTags], 200);
        //return redirect()->back()->with('message','article created');
        return view('adminCoverImage')->with('id', $article->id);
    }

    public function storeWriter(ArticleForm $request) {
      $userId=$request->user_id;
      $author=Author::where('user_id',$userId)->get();
      $word_count = str_word_count( $request->content );
        $time = ceil( $word_count / 250 );
        $articleData=[
            'author_id'=>$author[0]['id'],
            'cover_img'=>$request->cover_img,
            'title'=>$request->title,
            'byline'=>$request->byline,
            'read_time'=>round($time),
            'place'=>$request->place,
            'hero_article'=>$request->hero_article,
            'secondary_article'=>$request->secondary_article,
            'approved'=>$request->approved,
            'content'=>$request->content,
            'content_img'=>$request->content_img
        ];

        $article = Article::insertArticle($articleData);

        $tagstrings = $request->tags;
        $tags=explode(',',$tagstrings);

        $tagData=[
            'article_id'=>$article->id
        ];

        $allTags=[];
        foreach ($tags as $tag){
            $tagData['name']=strtolower($tag);
            $newTag = Tag::insertTag($tagData);
            array_push($allTags, $newTag);
        }

        //return response()->json(['article_data'=>$article,'tags'=>$allTags], 200);
        //return redirect()->back()->with('message','article created');
        return view('writer/writerCoverImage')->with('id', $article->id);
    }


    public function update(ArticleForm $request) {

        $id = $request->id;
        $word_count = str_word_count( $request->content );
        $time = ceil( $word_count / 250 );
        $articleData=[
            'cover_img'=>$request->cover_img,
            'title'=>$request->title,
            'byline'=>$request->byline,
            'place'=>$request->place,
            'read_time'=>round($time),
            'hero_article'=>$request->hero_article,
            'secondary_article'=>$request->secondary_article,
            'approved'=>$request->approved,
            'content'=>$request->content,
            'content_img'=>$request->content_img
        ];
        $tagstrings = $request->tags;
        $newTags=explode(',',$tagstrings);


        $tagData=[
            'article_id'=>$id
        ];
        $oldTags=Tag::where('article_id',$id)->get();

        if(count($oldTags)!=0){
            foreach($oldTags as $tag){
                $tag->delete();
            }
        }
        if(count($newTags)!=0){
            foreach($newTags as $tag){
                $tagData['name']=$tag;
                Tag::insertTag($tagData);
            }
        }
        $tags = Tag::where('article_id',$id)->get();
        $article = Article::updateArticle($articleData, $id);
        return redirect()->back();
    }
    public function destroyApproved(ArticleForm $request) {
        $id = $request->id;
        $article = Article::find($id);
        $article->delete();
        return redirect('/admin/articles');
    }
    public function destroyUnapproved(ArticleForm $request) {
        $id = $request->id;
        $article = Article::find($id);
        $article->delete();
        return redirect('/admin/approval-request');
    }

    public static function dashboardCount(){
        $article = Article::groupBy('approved')
        ->selectRaw('count(*) as articles, approved')
        ->get();
        $author=Author::selectRaw('count(*) as authors')->get();
        //return response()->json(['articles' => $article,'authors'=>$author], 200);
        return (1);
    }
    public static function approvedCount(){
        $apporvedArticle = Article::where('approved',1)->groupBy('approved')
        ->selectRaw('count(*) as articles, approved')
        ->get();
        return ($apporvedArticle);
    }
    public static function unapprovedCount(){
        $unapporvedArticle = Article::where('approved',0)->groupBy('approved')
        ->selectRaw('count(*) as articles, approved')
        ->get();
        return ($unapporvedArticle);
    }
    public static function authorCount(){
        $author=Author::selectRaw('count(*) as authors')->get();
        return ($author);
    }
    public static function updateSecondaryStatus(ArticleForm $request){
        $articleId = $request->id;
        if (!$request->secondary_article){
          $request->secondary_article=0;
        }
        else if ($request->secondary_article=='on'){
          $request->secondary_article=1;
        }
        if($request->hero_article==$request->secondary_article && $request->hero_article==1){
            $request->secondary_article=0;
        }
        $articleData = [
            'approved' => $request->approved,
            'hero_article' => $request->hero_article,
            'secondary_article' => $request->secondary_article,
            'author_id' => $request->author_id
        ];
        $article = Article::updateArticle($articleData,$articleId);
        //return($article);
        return redirect('/admin/articles');
    }
    public static function updateApprovedStatus(ArticleForm $request){
        $articleId = $request->id;
        if($request->hero_article==$request->secondary_article && $request->hero_article==1){
            $request->secondary_article=0;
        }
        $articleData = [
            'approved' => $request->approved,
            'hero_article' => $request->hero_article,
            'secondary_article' => $request->secondary_article,
            'author_id' => $request->author_id
        ];
        $article = Article::updateArticle($articleData,$articleId);
        return redirect('/admin/approval-request');
    }

    public static function getArticleByUserId($user_id) {
        $author = Author::where('user_id',$user_id)->get();
        $articles = Article::where('author_id',$author[0]['id'])->get();
        return($articles);
    }
    public function getArticleByAuthorId(ArticleForm $request,$author_id) {
        $articles = Article::where('author_id',$author_id)->get();
        foreach ($articles as $article) {
            $author=Author::find($author_id);
            $userId=$author['user_id'];
            $user=User::find($userId);
            $article['author']=$user['name'];
        }
        return new ArticleCollection($articles);
    }
    public function getArticleByTag(ArticleForm $request, $tag){
        $articleIds = Tag::where('name',$tag)->get();
        $articles= [];
        foreach($articleIds as $Id){
            $newArticle = Article::find($Id);
            array_push($articles, $newArticle);
        }
        return ($articles);
    }
    public function updateHero(ArticleForm $request){
        $articleId = $request->id;
        $articleIds = Article::where('hero_article',1)->get();
        $articleData = [
           'hero_article' => 0,
        ];
        foreach($articleIds as $Id){
            Article::updateArticle($articleData,$Id['id']);
        }
        $articleData = [
            'hero_article' => 1,
         ];
        $article = Article::updateArticle($articleData,$articleId);

        //return($article);
        return redirect('/admin/articles');
    }

    public static function getArticleByArticleId($article_id) {
        $article = Article::find($article_id);
            $author=Author::find($article['author_id']);
            $userId=$author['user_id'];
            $tags = Tag::where('article_id',$article['id'])->pluck('name');
            $article['tags'] = $tags->implode(',');
            $user=User::find($userId);
            $article['author']=$user['name'];
        //return new ArticleCollection($articles);
            return($article);
    }
    public static function updateCoverImage(Request $request){
      $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $id= $request->article_id;
        $imageName = $id . 'coverpic.jpg';

        $request->image->move(public_path('images'), $imageName);

         return redirect('/writer/article-success');
    }

    public static function updateAdminCoverImage(Request $request){
      $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $id= $request->article_id;
        $imageName = $id . 'coverpic.jpg';

        $request->image->move(public_path('images'), $imageName);

         return redirect('/admin/article-success');
    }

    public static function editCoverImage(Request $request){
      $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $id= $request->article_id;
        $imageName = $id . 'coverpic.jpg';

        $request->image->move(public_path('images'), $imageName);
        $articleData=[
          'approved'=>0
        ];
        $article=Article::updateArticle($articleData, $id);

         return redirect()->route('editArticleWriter', $id);
    }

    public static function editAdminCoverImage(Request $request){
      $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $id= $request->article_id;
        $imageName = $id . 'coverpic.jpg';

        $request->image->move(public_path('images'), $imageName);
        $articleData=[
          'approved'=>0
        ];
        $article=Article::updateArticle($articleData, $id);

         return redirect()->route('editArticAdmin', $id);
    }
}
