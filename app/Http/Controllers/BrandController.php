<?php

namespace App\Http\Controllers;

use App\Services\Contracts\BrandServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\AddBrandRequest;
use App\Http\Requests\UpdateBrandRequest;

class BrandController extends Controller
{

    protected BrandServiceInterface $brandServiceInterface;

    /**
     * @param BrandServiceInterface $brandServiceInterface
     */
    public function __construct(BrandServiceInterface $brandServiceInterface)
    {
        return $this->brandServiceInterface = $brandServiceInterface;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $data = $this->brandServiceInterface->list($request->all());

        return $this->handleRepond($data);
    }

    /**
     * @param AddBrandRequest $request
     * @return JsonResponse
     */
    public function store(AddBrandRequest $request): JsonResponse
    {
        $attributes = $request->all();

        $data = $this->brandServiceInterface->create($attributes);

        return $this->handleRepond($data);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $data = $this->brandServiceInterface->detail($id);

        return $this->handleRepond($data);
    }

    /**
     * @param UpdateBrandRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateBrandRequest $request, int $id): JsonResponse
    {
        $attributes = $request->all();

        $data = $this->brandServiceInterface->update($attributes, $id);

        return $this->handleRepond($data);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $data = $this->brandServiceInterface->delete($id);

        return $this->handleRepond($data);
    }
}
