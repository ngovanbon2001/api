<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Services\Contracts\OrderServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected OrderServiceInterface $orderService;

    /**
     * @param OrderServiceInterface $orderServiceInterface
     */
    public function __construct(OrderServiceInterface $orderServiceInterface)
    {
        $this->orderService = $orderServiceInterface;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $data = $this->orderService->list($request->all());

        return $this->handleRepond($data);
    }

    /**
     * @param AddOrderRequest $request
     * @return JsonResponse
     */
    public function store(AddOrderRequest $request): JsonResponse
    {
        $attributes = $request->all();

        $data = $this->orderService->create($attributes);

        return $this->handleResponse($data);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $data = $this->orderService->detail($id);

        return $this->handleResponse($data);
    }

    /**
     * @param UpdateOrderRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateOrderRequest $request, int $id): JsonResponse
    {
        $attributes = $request->all();

        $data = $this->orderService->update($attributes, $id);

        return $this->handleResponse($data);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $data = $this->orderService->delete($id);

        return $this->handleResponse($data);
    }
}
