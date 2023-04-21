<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Contracts\BannerServiceInterface;
use App\Http\Requests\AddBannerRequest;
use App\Http\Requests\UpdateBannerRequest;

class BannerController extends Controller
{
    protected $bannerService;
    public function __construct(BannerServiceInterface $bannerServiceInterface)
    {
        return $this->bannerService = $bannerServiceInterface;
    }

    public function index()
    {
        $data = $this->bannerService->all();

        return $this->handleRepond($data);
    }

    public function list(Request $request)
    {
        if(isset($request->title)) {
            return $this->handleRepond($this->bannerService->list($request->title));
        }
        return $this->bannerService->all();
    }

    public function store(AddBannerRequest $request)
    {
        $attributes = $request->all();

        // $imageName = "";

        // if ($request->has('image_url')) {
        //     $image = $request->file('image_url');
        //     $imageName = $image->getClientOriginalName();
        //     $image->move('images',  $imageName);
        // } else {
        //     $imageName = "no-image.png";
        // }

        // $attributes['image_url'] = $imageName;

        $data = $this->bannerService->create($attributes);

        return $this->handleRepond($data);
    }

    public function show($id)
    {
        $data = $this->bannerService->detail($id);

        return $this->handleRepond($data);
    }

    public function update(UpdateBannerRequest $request, $id)
    {
        $attributes = $request->all();

        // $imageName = "";

        // if ($request->has('image_url')) {
        //     $image = $request->file('image_url');
        //     $imageName = $image->getClientOriginalName();
        // } else {
        //     $imageName = $attributes['imageOld'];
        // }

        // $attributes['image_url'] = $imageName;

        $data = $this->bannerService->update($attributes, $id);

        return $this->handleRepond($data);
    }

    public function destroy($id)
    {
        $attributes = ['active' => 2];

        $data = $this->bannerService->delete($attributes, $id);

        return $this->handleRepond($data);
    }
}
