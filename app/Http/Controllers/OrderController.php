<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\BannerRepositoryInterface;
use App\Services\Contracts\BannerServiceInterface;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $banner;
    public function __construct(BannerRepositoryInterface $interface)
    {
        $this->banner = $interface;
    }

    public function show($id)
    {
        $data = $this->banner->testData($id);
        return $this->handleRepond($data);
    }

}
