<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreRequest;
use App\Models\Product;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use ApiResponse;

    protected $products;

    public function __construct()
    {
        $this->products = new Product();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = $this->products->with('category')->get();

        return $this->showAll($products, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $product = $this->products->create($request->all());

        return $this->showOne($product, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $products = $this->products->with('category')->findOrFail($id);

        return $this->showOne($products, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, string $id)
    {
        $product = $this->products->findOrFail($id);
        $product->update(array_filter($request->validated()));

        return $this->showOne($product, 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = $this->products->findOrFail($id);
        $product->delete();

        return $this->showOne($product, 200);
    }
}
