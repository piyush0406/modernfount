<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Http\Controllers\Api\ArticleController;

class WebController extends Controller
{
    public function welcome()
    {
        return view('welcome');
    }
    public function article()
    {
        return view('article');
    }
    public function adminDashboard()
    {

        return view('adminDashboard');
    }
    public function userCreation()
    {
        return view('userCreation');
    }
    public function approvalRequest()
    {
        return view('approvalRequest');
    }
    public function articles()
    {
        return view('articles');
    }
    public function adminCreateArticle()
    {
        return view('adminCreateArticle');
    }
    public function adminSuccess()
    {
        return view('adminSuccess');
    }
    public function userCreated()
    {
        return view('userCreated');
    }
    public function writerDashboard()
    {
        return view('writer/writerDashboard');
    }
    public function articleListing()
    {
        return view('writer/articleListing');
    }
    public function createArticle()
    {
        return view('writer/createArticle');
    }
    public function writerCoverImage($id)
    {
        return view('writer/writerCoverImage')->with('id', $id);
    }
    public function adminCoverImage($id)
    {
        return view('adminCoverImage')->with('id', $id);
    }
    public function writers()
    {
        return view('writers');
    }
    public function writerSuccess()
    {
        return view('writer/writerSuccess');
    }
    public function tags()
    {
        return view('tags');
    }
    public function tag($name)
    {
        return view('tag')->with('name', $name);
    }
    public function signin()
    {
        return view('signin');
    }
    public function articleDisplay($id)
    {
        return view('articleDisplay')->with('id', $id);
    }
    public function writer($id)
    {
        return view('writer')->with('id', $id);
    }
    public function editArticleAdmin($id)
    {
        return view('editArticleAdmin')->with('id', $id);
        //return($id);
    }
    public function editArticle($id)
    {
        return view('writer/editArticle')->with('id', $id);
        //return($id);
    }


}
