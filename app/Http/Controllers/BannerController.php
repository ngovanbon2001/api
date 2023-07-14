<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Services\Contracts\BannerServiceInterface;
use App\Http\Requests\AddBannerRequest;
use App\Http\Requests\UpdateBannerRequest;

class BannerController extends Controller
{
    protected BannerServiceInterface $bannerService;

    /**
     * @param BannerServiceInterface $bannerServiceInterface
     */
    public function __construct(BannerServiceInterface $bannerServiceInterface)
    {
        return $this->bannerService = $bannerServiceInterface;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        return $this->handleRepond($this->bannerService->list($request->all()));
    }

    /**
     * @param AddBannerRequest $request
     * @return JsonResponse
     */
    public function store(AddBannerRequest $request): JsonResponse
    {
        $attributes = $request->all();

        $data = $this->bannerService->create($attributes);

        return $this->handleRepond($data);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $data = $this->bannerService->detail($id);

        return $this->handleRepond($data);
    }

    /**
     * @param UpdateBannerRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateBannerRequest $request, int $id): JsonResponse
    {
        $attributes = $request->all();

        $data = $this->bannerService->update($attributes, $id);

        return $this->handleRepond($data);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $data = $this->bannerService->delete($id);

        return $this->handleRepond($data);
    }
}
