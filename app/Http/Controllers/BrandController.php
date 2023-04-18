<?php

namespace App\Http\Controllers;

use App\Services\Contracts\BrandServiceInterface;
use Illuminate\Http\Request;
use App\Http\Requests\AddBrandRequest;
use App\Http\Requests\UpdateBrandRequest;

class BrandController extends Controller
{
    protected $brandServiceInterface;

    public function __construct(BrandServiceInterface $brandServiceInterface)
    {
        return $this->brandServiceInterface = $brandServiceInterface;
    }

    public function index()
    {
        $data = $this->brandServiceInterface->all();

        return $this->handleRepond($data);
    }

    public function store(AddBrandRequest $request)
    {
        $attributes = $request->all();

        $data = $this->brandServiceInterface->create($attributes);

        return $this->handleRepond($data);
    }

    public function show($id)
    {
        $data = $this->brandServiceInterface->detail($id);

        return $this->handleRepond($data);
    }

    public function update(UpdateBrandRequest $request, $id)
    {
        $attributes = $request->all();

        $data = $this->brandServiceInterface->update($attributes, $id);

        return $this->handleRepond($data);
    }

    public function destroy($id)
    {
        $attributes = ['active' => 2];

        $data = $this->brandServiceInterface->delete($attributes, $id);

        return $this->handleRepond($data);
    }
}
