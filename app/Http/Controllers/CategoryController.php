<?php

namespace App\Http\Controllers;

use App\Services\Contracts\CategoryServiceInterface;
use Illuminate\Http\Request;
use App\Http\Requests\AddCateRequest;
use App\Http\Requests\UpdateCateRequest;

class CategoryController extends Controller
{
    protected $cateServiceInterface;

    public function __construct(CategoryServiceInterface $cateServiceInterface)
    {
        return $this->cateServiceInterface = $cateServiceInterface;
    }

    public function index(Request $request)
    {
        $data = $this->cateServiceInterface->list($request->all());

        return $this->handleRepond($data);
    }

    public function store(AddCateRequest $request)
    {
        $attributes = $request->all();

        $data = $this->cateServiceInterface->create($attributes);

        return $this->handleRepond($data);
    }

    public function show($id)
    {
        $data = $this->cateServiceInterface->detail($id);

        return $this->handleRepond($data);
    }

    public function update(UpdateCateRequest $request, $id)
    {
        $attributes = $request->all();

        $data = $this->cateServiceInterface->update($attributes, $id);

        return $this->handleRepond($data);
    }

    public function destroy($id)
    {
        $attributes = ['active' => 2];

        $data = $this->cateServiceInterface->delete($attributes, $id);

        return $this->handleRepond($data);
    }
}
