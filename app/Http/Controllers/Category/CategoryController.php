<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreRequest;
use App\Models\Category;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use ApiResponse;

    protected $categories;

    public function __construct()
    {
        $this->categories = new Category();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = $this->categories->with('products')->get();

        return $this->showAll($categories, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $category = $this->categories->create($request->all());

        return $this->showOne($category, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = $this->categories->with('products')->findOrFail($id);

        return $this->showOne($category, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, string $id)
    {
        $category = $this->categories->findOrFail($id);
        $category->update(array_filter($request->validated()));

        return $this->showOne($category, 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = $this->categories->findOrFail($id);
        $category->delete();

        return $this->showOne($category, 200);
    }
}
