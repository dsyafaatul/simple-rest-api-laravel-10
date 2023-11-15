<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Post;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->get();
        return response()->json([
            "status" => true,
            "message" => "List Semua Posts",
            "data" => $posts
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "title" => "required",
            "content" => "required"
        ], [
            "title.required" => "Masukan Title Post !",
            "content.required" => "Masukan Content Post !"
        ]);

        if($validator->fails()){
            return response()->json([
                "status" => false,
                "message" => "Silahkan Isi Bidang Yang Kosong",
                "data" => $validator->errors()
            ], 401);
        }else{
            $post = Post::create([
                "title" => $request->input("title"),
                "content" => $request->input("content")
            ]);

            if($post){
                return response()->json([
                    "status" => true,
                    "message" => "Post Berhasil Disimpan!"
                ], 200);
            }else{
                return response()->json([
                    "status" => false,
                    "message" => "Post Gagal Disimpan!",
                ], 401);
            }
        }
    }

    public function show($id)
    {
        $post = Post::whereId($id)->first();

        if($post){
            return response()->json([
                "status" => true,
                "message" => "Detail Post!",
                "data" => $post
            ], 200);
        }else{
            return response()->json([
                "status" => true,
                "message" => "Post tidak ditemukan!",
                "data" => $post
            ], 401);
        }
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "title" => "required",
            "content" => "required"
        ], [
            "title.required" => "Masukan Title Post !",
            "content.required" => "Masukan Content Post !"
        ]);

        if($validator->fails()){
            return response()->json([
                "status" => false,
                "message" => "Silahkan Isi Bidang Yang Kosong",
                "data" => $validator->errors()
            ], 401);
        }else{
            $post = Post::whereId($request->input("id"))->update([
                "title" => $request->input("title"),
                "content" => $request->input("content")
            ]);
            
            if($post){
                return response()->json([
                    "status" => true,
                    "message" => "Post Berhasil Diupdate!"
                ], 200);
            }else{
                return response()->json([
                    "status" => false,
                    "message" => "Post Gagal Diupdate!",
                ], 401);
            }
        }
    }
}
