<?php

namespace App\Http\Controllers\Api;

use App\Article;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Author;
use App\User;
use App\Http\Requests\AuthorForm;
use App\Http\Resources\AuthorResource;

class AuthorController extends Controller
{
    public static function index() {
        $authors = Author::get();
        foreach ($authors as $author) {
            $userId=$author['user_id'];
            $user=User::find($userId);
            $author['name']=$user['name'];
            $author['profile_pic']=$user['profile_pic'];
            $author['email']=$user['email'];
            $author['mobile']=$user['mobile'];
        }
        //return new AuthorResource($authors);
        return($authors);
    }
    public static function getAuthorById($id) {
        $author = Author::where('user_id',$id)->get();
        if($author->isEmpty()){
            $authorData=[
              'user_id'=>$id,
            ];
            Author::create($authorData);
        }      
        $author = Author::where('user_id',$id)->get();
        //foreach ($authors as $author) {
            //$userId=$author['user_id'];
            $user=User::find($id);
            //echo ($user); die();
            $author[0]['name']=$user['name'];
            $author[0]['profile_pic']=$user['profile_pic'];
            $author[0]['email']=$user['email'];
            $author[0]['mobile']=$user['mobile'];
      //  }
        //return new AuthorResource($authors);
        //echo ($author); die();
        return($author);
    }

    public function store(AuthorForm $request) {
        $author = Author::insertAuthor($request);
        return response()->json(['data' => new AuthorResource($author)], 200);
    }

    public function update(AuthorForm $request) {
        $userId = $request->id;
        $author = Author::where('user_id',$userId)->get();
        $id=$author[0]['id'];
        $author = Author::updateAuthor($request, $id);
        $userData = [
            'profile_pic' => $request->profile_pic,
            'mobile' => $request->mobile,
            'name' => $request->name,
        ];
        $user = User::updateUser($userData,$userId);
        //echo($author);die();
        return redirect('writer');
        //return response()->json(['data' => new AuthorResource($author)], 200);
    }
    public function destroy(AuthorForm $request) {
        $id = $request->id;
        $author = Author::find($id);
        $author->delete();
        return response()->json(array(), 204);
    }
    public static function authorList(){

        $authors = Author::select('user_id')->get();
        foreach($authors as $author){
            $user=User::find($author['user_id']);
            $author['name'] = $user['name'];
        }
        return $authors;
    }
    public static function authorPost(){
        $posts = Article::where('approved',1)->groupBy('author_id')->selectRaw('count(*) as posts, author_id')->orderBy('posts','DESC')->get();
        $allAuthor=[];
        foreach ($posts as $post){
            $author= Author::find($post['author_id']);
            $userId=$author['user_id'];
            $user=User::find($userId);
            $author['name']=$user['name'];
            $author['profile_pic']=$user['profile_pic'];
            $author['posts'] = $post['posts'];
            array_push($allAuthor, $author);
        }
        return $allAuthor;
    }
    public static function getAuthorByAuthorId($id){
        $author = Author::find($id);
        $userId=$author['user_id'];
        $user=User::find($userId);
        $author['name']=$user['name'];
        $author['profile_pic']=$user['profile_pic'];
        $posts = Article::where('author_id',$id)->where('approved',1)->selectRaw('count(*) as posts')->get();
        $author['posts'] = $posts[0]['posts'];
        return $author;

    }
    public static function updateImage(Request $request){
      $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $id= $request->user_id;
        $imageName = $id . 'profilepic.jpg';

        $request->image->move(public_path('images'), $imageName);
        //echo ($imageName); die();

         return back()
             ->with('success','You have successfully upload image.')
             ->with('image',$imageName);
    }
}
