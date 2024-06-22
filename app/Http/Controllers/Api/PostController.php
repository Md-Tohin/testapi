<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Http\Resources\ErrorResource;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\PostResource;
use App\Http\Requests\PostRequest;
use App\Http\Requests\PostUpdateRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Post::orderBy('id', 'desc')->get();
        return new SuccessResource(['message' => 'All Category', 'data' => $data ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $formData = $request->validated();
        $formData['slug'] = Str::slug($formData['title']);
        $formData['created_by'] =  Auth::user() ? Auth::user()->id : 0;

        Post::create($formData);

        return (new SuccessResource(['message' => 'Post Successfully Created!']))->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $formateData = new PostResource($post);
        return new SuccessResource(['data' => $formateData]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostUpdateRequest $request, Post $post)
    {
        $formData = $request->validated();
        $formData['slug'] = Str::slug($formData['title']);
        $formData['updated_by'] =  Auth::user() ? Auth::user()->id : 0;

        $post->update($formData);

        return new SuccessResource(['message' => 'Post Successfully Updated!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return new SuccessResource(['message' => 'Post Successfully Deleted!']);
    }
}
