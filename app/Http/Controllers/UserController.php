<?php

namespace App\Http\Controllers;

use App\Services\Contracts\UserServiceInterface;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;


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


    public function create(UserRequest $request)
    {
        $attributes = $request->all();
        $attributes['password'] = bcrypt($attributes['password']);
        $data = $this->userService->create($attributes);

        return $this->handleRepond($data);
    }

    public function update(UserRequest $request)
    {
        $attributes = $request->all();
        $data = $this->userService->update($attributes, $request->id);

        return $this->respond($data);
    }

    public function delete(Request $request)
    {
        $data = $this->userService->delete($request->id);

        return $this->respond($data);
    }

    public function detail(Request $request)
    {
        $data = $this->userService->detail($request->id);

        return $this->respond($data);
    }


    public function detailTest(Request $request)
    {
        $data = $this->userService->detailTest($request->email);

        return $this->respond(200, "Data", $data);
    }

    public function login(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($data)) {
            $user = Auth::user();
            $token = $user->createToken('Laravel8PassportAuth')->accessToken;
            $token = 'Bearer ' . $token;
            return response()->json(['data' => $user, 'token' => $token], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function logout()
    {
        $user = Auth::user()->token();
        $user->revoke();
        return response()->json(['message' => 'Logout Success'], 200);
    }

    public function list(Request $request)
    {
        $data = $this->userService->list($request->all());

        return $this->handleRepond($data);
    }
}
