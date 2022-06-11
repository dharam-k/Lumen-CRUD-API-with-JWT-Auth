<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function fetchAllPosts(){
        return Post::all();
    }

    public function fetchByPostsID($postID){
        return Post::find($postID);
    }

    public function createPosts(Request $request){
        $title=$request->title;
        $content=$request->content;

        if(empty($title) OR empty($content)){
            return response()->json(['status'=>'failed', 'message'=>'All fields are Required!']);
        }

        $this->validate($request, [
            'title'=> 'string',
            'content'=> 'string'
        ]);

        Post::create([
            'title' => $title,
            'content' => $content
        ]);

        return response()->json(['status'=>'success', 'operation'=>'create', 'message'=>'New Post Created!']);

    }

    public function updatePosts(Request $request, $id){

        
        $this->validate($request, [
            'title'=> 'string',
            'content'=> 'string'
        ]);

        $post = Post::find($id);



        $post->title=$request->title;
        $post->content=$request->content;

        if(empty($post->title) OR empty($post->content)){
            return response()->json(['status'=>'failed', 'message'=>'All fields are Required!']);
        }

        $post->update();

        return response()->json(['status'=>'success', 'operation'=>'update', 'message'=>'Post has been Updated!']);
    }

    public function deletePost($id){
        $post = Post::find($id);

        if($post){
            if($post->delete()){
                return response()->json(['status'=>'success', 'operation'=>'delete', 'message'=>'Post has been Deleted!']);
             }
        }else{
            return response()->json(['status'=>'failed',  'message'=>'Post ID is not available!']);
        }
        

    }
    
    public function deleteAllPosts(){
        $post= Post::truncate();

        if($post){
          return response()->json(['status'=>'success', 'operation'=>'delete', 'message'=>'All Posts have been Deleted!']);
        }else{
            return response()->json(['status'=>'success', 'message'=>'Posts are not available']);
        }

    }
}
