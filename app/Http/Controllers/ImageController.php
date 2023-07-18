<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateImageRequest;
use App\Services\Contracts\ImageServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    protected ImageServiceInterface $imageServiceInterface;

    /**
     * @param ImageServiceInterface $imageServiceInterface
     */
    public function __construct(ImageServiceInterface $imageServiceInterface)
    {
        $this->imageServiceInterface = $imageServiceInterface;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $data = $this->imageServiceInterface->list($request->all());

        return $this->handleResponse($data);
    }

    /**
     * @param CreateImageRequest $request
     * @return JsonResponse
     */
    public function store(CreateImageRequest $request): JsonResponse
    {
        $attributes = $request->all();

        $data = $this->imageServiceInterface->create($attributes);

        return $this->handleResponse($data);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $data = $this->imageServiceInterface->detail($id);

        return $this->handleResponse($data);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $attributes = $request->all();

        $data = $this->imageServiceInterface->update($attributes, $id);

        return $this->handleResponse($data);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $data = $this->imageServiceInterface->delete($id);

        return $this->handleResponse($data);
    }
}
