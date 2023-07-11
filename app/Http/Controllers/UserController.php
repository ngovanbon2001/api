<?php

namespace App\Http\Controllers;

use App\Services\Contracts\UserServiceInterface;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Passport\Token;

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

    public function delete($id)
    {
        $data = $this->userService->delete($id);

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
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $tokenResult = $user->createToken('MyApp');
            $accessToken = $tokenResult->accessToken;
            
            $refreshToken = new Token([
                'id' => hash('sha256', Str::random(40)),
                'user_id' => $user->id,
                'client_id' => 11,
                'name' => 'MyApp',
                'scopes' => [],
                'revoked' => false,
                'expires_at' => now()->addDays(7),
            ]);
            $refreshToken->save();
        
            return response()->json([
                'data' => $user,
                'token' => 'Bearer '. $accessToken,
                'refresh_token' => $refreshToken->id,
            ]);
        }
    
        return response()->json(['error' => 'Unauthorized'], 401);
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
