<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Services\Contracts\OrderServiceInterface;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderService;
    public function __construct(OrderServiceInterface $orderServiceInterface)
    {
        $this->orderService = $orderServiceInterface;
    }

    public function index(Request $request)
    {
        $data = $this->orderService->list($request->all());

        return $this->handleRepond($data);
    }

    public function store(AddOrderRequest $request)
    {
        $attributes = $request->all();

        $data = $this->orderService->create($attributes);

        return $this->handleRepond($data);
    }

    public function show($id)
    {
        $data = $this->orderService->detail($id);

        return $this->handleRepond($data);
    }

    public function update(UpdateOrderRequest $request, $id)
    {
        $attributes = $request->all();

        $data = $this->orderService->update($attributes, $id);

        return $this->handleRepond($data);
    }

    public function destroy($id)
    {
        $attributes = ['active' => 2];

        $data = $this->orderService->delete($attributes, $id);

        return $this->handleRepond($data);
    }
}
