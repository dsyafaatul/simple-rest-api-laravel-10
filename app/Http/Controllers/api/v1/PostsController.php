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
}
