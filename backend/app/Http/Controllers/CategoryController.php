<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Category::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:15'
        ]);

        $category = Category::create($validatedData);

        return response()->json($category , 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $category = Category::findByName($category);
        if(!$category) {
            return response()->json(["message" => "category not found"]);
        }

        return response()->json($category , 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:15'
        ]);

        $category = Category::findByName($category) ;

        $category->update($validatedData);

        return response()->json($category , 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category = Category::findByName($category);

        if(!$category) {
            return response()->json(["message" => "category not found"]);
        }

        $category->delete();

        return response()->json(["message" => "category deleted successfully"]);
    }
}
