<?php

namespace App\Http\Controllers;

use App\Services\Contracts\CategoryServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\AddCateRequest;
use App\Http\Requests\UpdateCateRequest;

class CategoryController extends Controller
{
    protected CategoryServiceInterface $cateServiceInterface;

    /**
     * @param CategoryServiceInterface $cateServiceInterface
     */
    public function __construct(CategoryServiceInterface $cateServiceInterface)
    {
        return $this->cateServiceInterface = $cateServiceInterface;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $data = $this->cateServiceInterface->list($request->all());

        return $this->handleRepond($data);
    }

    /**
     * @param AddCateRequest $request
     * @return JsonResponse
     */
    public function store(AddCateRequest $request): JsonResponse
    {
        $attributes = $request->all();

        $data = $this->cateServiceInterface->create($attributes);

        return $this->handleRepond($data);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $data = $this->cateServiceInterface->detail($id);

        return $this->handleRepond($data);
    }

    /**
     * @param UpdateCateRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateCateRequest $request, int $id): JsonResponse
    {
        $attributes = $request->all();

        $data = $this->cateServiceInterface->update($attributes, $id);

        return $this->handleRepond($data);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $data = $this->cateServiceInterface->delete($id);

        return $this->handleRepond($data);
    }
}
