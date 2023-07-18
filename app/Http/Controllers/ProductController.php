<?php

namespace App\Http\Controllers;

use App\Services\Contracts\ProductServiceInterface;
use App\Http\Requests\AddProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected ProductServiceInterface $productServiceInterface;

    /**
     * @param ProductServiceInterface $productServiceInterface
     */
    public function __construct(ProductServiceInterface $productServiceInterface)
    {
        return $this->productServiceInterface = $productServiceInterface;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $data = $this->productServiceInterface->list($request->all());

        return $this->handleResponse($data);
    }

    /**
     * @param AddProductRequest $request
     * @return JsonResponse
     */
    public function store(AddProductRequest $request): JsonResponse
    {
        $attributes = $request->all();

        $data = $this->productServiceInterface->create($attributes);

        return $this->handleResponse($data);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $data = $this->productServiceInterface->detail($id);

        return $this->handleResponse($data);
    }

    /**
     * @param UpdateProductRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateProductRequest $request, int $id): JsonResponse
    {
        $attributes = $request->all();

        $data = $this->productServiceInterface->update($attributes, $id);

        return $this->handleResponse($data);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $data = $this->productServiceInterface->delete($id);

        return $this->handleResponse($data);
    }
}
