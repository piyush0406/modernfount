<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;


class Author extends Model
{
  protected $fillable=['user_id', 'qualification','expertise', 'about', 'fb_link', 'hero_author', 'tweet_link', 'insta_link'];
  use SoftDeletes, SoftCascadeTrait;
    protected $softCascade = ['article'];
    public function article()
    {
        return $this->hasMany('App\Article');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public static function insertAuthor($request){
        $parameters = $request->only(
            'user_id' ,
            'qualification' ,
            'about' ,
            'hero_author',
            'expertise',
            'fb_link' ,
            'tweet_link',
            'insta_link'
			);

        $author = new Author();
        foreach ($parameters as $key => $value) {
            $author->{$key} = $value;
		}

        $author->save();
        return $author;
    }
    public static function updateAuthor($request, $id){

        $parameters = $request->only(
            'user_id' ,
            'qualification' ,
            'about' ,
            'hero_author',
            'expertise',
            'fb_link' ,
            'tweet_link',
            'insta_link' );

        $author = Author::find($id);
        foreach ($parameters as $key => $value) {
            $author->{$key} = $value;
		}

        $author->save();
        return $author;
	}

}
