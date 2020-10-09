<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Author;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserForm;
use App\Http\Resources\UserResource;
class UserController extends Controller
{
    public function register(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|max:55',
            'email'=> 'email|required|unique:users',
            'password'=>'required|confirmed',
            'mobile' => 'required'
        ]);
        $validateData['password'] =bcrypt($request->password);
        $validateData['role'] = 2;
        $user= User::create($validateData);
        $authorData=[
          'user_id'=>$user['id']
        ];
        $author = Author::create($authorData);
        $user['author_id'] = $author['id'];
        // $accessToken=$user->createToken('authToken')->accessToken;
        //return (['message', "User Created"]);
        return redirect('/admin/user-success');

    }
    public function login(Request $request){
        $login = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if(!auth()->attempt($login)){
            return view('signin', ['message'=>'invalid login credentials']);
        }
        $accessToken=auth()->user()->createToken('authToken')->accessToken;
        return view('adminDashboard', ['user'=>auth()->user(),'access_token'=>$accessToken]);
    }
    public function update(UserForm $request, $id) {
        $validateData = $request->validate([
            'name' => 'string|max:55',
            'profile_pic'=>'string',
            'mobile'=>'integer',

        ]);
        if($request->password){
            $validateData['password'] =bcrypt($request->password);
        }
        $user = User::updateUser($validateData, $id);
        return response()->json(['data' => new UserResource($user)], 200);
    }
    public function destroy(UserForm $request, $id) {
        $user = User::find($id);
        $user->delete();
        return response()->json(array(), 204);
    }
}
