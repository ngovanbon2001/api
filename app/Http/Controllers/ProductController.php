<?php

namespace App\Http\Controllers;

use App\Services\Contracts\ProductServiceInterface;
use App\Http\Requests\AddProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    protected $productServiceInterface;

    public function __construct(ProductServiceInterface $productServiceInterface)
    {
        return $this->productServiceInterface = $productServiceInterface;
    }

    public function index()
    {
        $data = $this->productServiceInterface->all();

        return $this->handleRepond($data);
    }

    public function store(AddProductRequest $request)
    {
        $attributes = $request->all();

        $data = $this->productServiceInterface->create($attributes);

        return $this->handleRepond($data);
    }

    public function show($id)
    {
        $data = $this->productServiceInterface->detail($id);

        return $this->handleRepond($data);
    }

    public function update(UpdateProductRequest $request, $id)
    {
        $attributes = $request->all();

        $data = $this->productServiceInterface->update($attributes, $id);

        return $this->handleRepond($data);
    }

    public function destroy($id)
    {
        $attributes = ['active' => 2];

        $data = $this->productServiceInterface->delete($attributes, $id);

        return $this->handleRepond($data);
    }
}
