<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

class Tag extends Model
{
    use SoftDeletes;
    public function article()
    {
        return $this->belongsTo('App\Article');
    }

    public static function insertTag($tagData){


        $tag = new Tag();
        foreach ($tagData as $key => $value) {
            $tag->{$key} = $value;
		}

        $tag->save();
        return $tag;
	}
}
