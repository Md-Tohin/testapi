<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('id', 'desc')->get();
        return response()->json([
            'success' => 200,
            'message' => 'Category successfully retrieved',
            'data' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'code' => 'required|unique:categories',
            'name' => 'required|string|unique:categories',
            'icon' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2040',
            'description' => 'required',
            'discount' => 'required|numeric',
        ]);
        if ($validation->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'errors' => $validation->getMessageBag(),
            ], 422);
        }

        $formData = $validation->validated();
        $formData['slug'] = Str::slug($formData['name']);

        if (array_key_exists('image', $formData)) {
            $formData['image'] = Storage::putFile('', $formData['image']);
        }

        Category::create($formData);

        return response()->json([
            'success' => true,
            'message' => 'Successfully Category Created!',
            'data' => [],
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);
        if (!$category) {
            return response()->json([
               'success' => false,
               'message' => 'Category not found',
                'data' => [],
            ], 404);
        }
        return response()->json([
           'success' => 200,
           'message' => 'Category successfully retrieved',
            'data' => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        if (!$category) {
            return response()->json([
               'success' => false,
               'message' => 'Category not found',
                'data' => [],
            ], 404);
        }

        $validation = Validator::make($request->all(), [
            'code' => 'required|unique:categories,code,' .$id,
            'name' => 'required|string|unique:categories,name,'. $id,
            'icon' => 'required',
            'image' => 'required',
            'description' => 'required',
            'discount' => 'required|numeric',
        ]);
        if ($validation->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'errors' => $validation->getMessageBag(),
            ], 422);
        }

        $formData = $validation->validated();
        $formData['slug'] = Str::slug($formData['name']);

        if (array_key_exists('image', $formData)) {
            Storage::delete($category->image);
            $formData['image'] = Storage::putFile('', $formData['image']);
        }

        $category->update($formData);

        return response()->json([
            'success' => true,
            'message' => 'Successfully Category Updated!',
            'data' => [],
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        if (!$category) {
            return response()->json([
               'success' => false,
               'message' => 'Category not found',
                'data' => [],
            ], 404);
        }
        Storage::delete($category->image);
        $category->delete();
        return response()->json([
            'success' => true,
            'message' => 'Successfully Category Deleted!',
            'data' => [],
        ]);
    }
}
