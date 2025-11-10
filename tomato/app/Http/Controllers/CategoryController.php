<?php

namespace App\Http\Controllers;

use App\Http\Resources\Category\CategoryResource;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    public function index()
    {
        return CategoryResource::collection(Category::all())->resolve();
    }

    public function show(Category $category)
    {
        return CategoryResource::make($category)->resolve();
    }

    public function store()
    {
        $category = Category::create([
            'title' => 'Wow title for category from controller',
        ]);
        return $category;
    }

    public function update(Category $category)
    {
        $category->update(['title' => 'New Title']);
    }

    public function destroy(Category $category){
        $category->delete();
        return response(['message' => 'Category destroyed'], Response::HTTP_OK);
    }
}
