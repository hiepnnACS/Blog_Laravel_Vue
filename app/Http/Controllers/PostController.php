<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Auth;
use Intervention\Image\ImageManagerStatic as Image;
use File;

class PostController extends Controller
{
    public function getPost()
    {
        $post = Post::with('user', 'category')->get();
        // dd($post);

        return response()->json([
            'post' => $post
        ]);
    }

    public function savePost(Request $request)
    {
        
            $this->validate($request, [
                'post_title' => 'required|min:2|max:200|unique:posts,title',
                'post_desc' => 'required|min:30|max:200',
                
            ]);
                
            // handel img
            $strpos = strpos($request->photo, ';');
            $sub = substr($request->photo,0, $strpos);
            $ex = explode('/', $sub)[1];
            $name = time().".".$ex;
            $img = Image::make($request->photo)->resize(200, 200);
            $upload_path = public_path()."/uploadimage/";
            $img->save($upload_path.$name);

            $data_post = [
            'title' => $request->post_title,
            'description' => $request->post_desc,
            'user_id' => Auth::id(),
            'cate_id' => $request->cate_id,
            'photo' => $name
        ];

        Post::create($data_post);

        return ['message' => 'ok'];
    }

    public function deletePost($id)
    {
        $post = Post::findOrFail($id);

        $img_path = public_path() . "/uploadimage/" . $post->photo;

        if(File::exists($img_path)) {
            File::delete($img_path);
        }
        
        $post->delete();
    }

    public function editPost($id)
    {
        $post = Post::findOrFail($id);

        return response()->json([
            'post' => $post,
        ], 200);
    }

    public function updatePost($id, Request $request)
    {
        $post = Post::findOrFail($id);
        if($request->photo != $post->photo) {
            $strpos = strpos($request->photo, ';');
            $sub = substr($request->photo, 0, $strpos);
            $ex = explode('/', $sub)[1];
            $name = time(). "." .$ex;
            $img = Image::make($request->photo)->resize(200, 200);
            $upload_path = public_path(). "/uploadimage/";
            $image = $upload_path. $post->photo;
            $img->save($upload_path.$name);

            if(File::exists($image)) {
                File::delete($image);
            }
        } else {
            $name = $post->photo;
        }

        $data_post = [
            $post->title = $request->title,
            $post->description = $request->description,
            $post->cate_id = $request->cate_id,
            $post->user_id = Auth::id(),
            $post->photo = $name,
        ];

        $post->save();
    }
}
