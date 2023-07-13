<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateImageRequest;
use App\Services\Contracts\ImageServiceInterface;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    protected $imageServiceInterface;
    public function __construct(ImageServiceInterface $imageServiceInterface)
    {
        $this->imageServiceInterface = $imageServiceInterface;
    }

    public function index(Request $request)
    {
        $data = $this->imageServiceInterface->list($request->all());

        return $this->handleRepond($data);
    }

    public function store(CreateImageRequest $request)
    {
        $attributes = $request->all();

        $data = $this->imageServiceInterface->create($attributes);

        return $this->handleRepond($data);
    }

    public function show($id)
    {
        $data = $this->imageServiceInterface->detail($id);

        return $this->handleRepond($data);
    }

    public function update(Request $request, $id)
    {
        $attributes = $request->all();

        $data = $this->imageServiceInterface->update($attributes, $id);

        return $this->handleRepond($data);
    }

    public function destroy($id)
    {
        $data = $this->imageServiceInterface->delete($id);

        return $this->handleRepond($data);
    }
}
