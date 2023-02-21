<?php

namespace App\Http\Controllers;

use App\Services\Contracts\UserServiceInterface;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{

    protected $userService;

    public function __construct(UserServiceInterface $userService)
    {
        return $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $attributes = $request->all();
        $data = $this->userService->list($attributes);

        return $this->respond($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $attributes = $request->all();
        $data = $this->userService->create($attributes);

        return $this->respond($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $attributes = $request->all();
        $data = $this->userService->update($attributes, $attributes->id);

        return $this->respond($data);
    }

    public function delete(Request $request)
    {
        $attributes = $request->only(['id']);
        $data = $this->userService->delete($attributes->id);

        return $this->respond($data);
    }

    public function detail(Request $request)
    {
        $attributes = $request->only(['id']);
        $data = $this->userService->detail($attributes->id);

        return $this->respond($data);
    }


    public function respond(int $code = 0, string $message = '', $data = null, int $httpCode = Response::HTTP_OK, array $headers = [], int $options = 0)
    {
        $response = [
            'code' => $code,
            'message' => $message,
            'data' => $data,
        ];

        return response()->json($response, $httpCode, $headers, $options);
    }
}
