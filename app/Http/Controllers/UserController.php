<?php

namespace App\Http\Controllers;

use App\Services\Contracts\UserServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Laravel\Passport\Token;
use Google_Client;
use Google_Service_Oauth2;
use Socialite;

class UserController extends Controller
{

    protected UserServiceInterface $userService;

    /**
     * @param UserServiceInterface $userService
     */
    public function __construct(UserServiceInterface $userService)
    {
        return $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $attributes = $request->all();
        $data = $this->userService->list($attributes);

        return $this->handleResponse($data);
    }

    /**
     * @param UserRequest $request
     * @return JsonResponse
     */
    public function create(UserRequest $request): JsonResponse
    {
        $attributes = $request->all();
        $attributes['password'] = bcrypt($attributes['password']);
        $data = $this->userService->create($attributes);

        return $this->handleRepond($data);
    }

    /**
     * @param UserRequest $request
     * @return JsonResponse
     */
    public function update(UserRequest $request): JsonResponse
    {
        $attributes = $request->all();
        $data = $this->userService->update($attributes, $request->input("id"));

        return $this->respond($data);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function delete(int $id): JsonResponse
    {
        $data = $this->userService->delete($id);

        return $this->respond($data);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function detail(Request $request): JsonResponse
    {
        $data = $this->userService->detail($request->input("id"));

        return $this->respond($data);
    }


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function detailTest(Request $request): JsonResponse
    {
        $data = $this->userService->detailTest($request->input("email"));

        return $this->respond(200, "Data", $data);
    }

    public function redirectToGoogle()
    {
        try {
            $client = new Google_Client();
            $client->setClientId(config('services.google.client_id'));
            $client->setClientSecret(config('services.google.client_secret'));
            $client->setRedirectUri(config('services.google.redirect'));
            $client->setScopes(['email', 'profile']);

            return $client->createAuthUrl();
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return $e->getMessage();
        }
    }

    public function handleGoogleCallback(Request $request)
    {
        try {
            $client = new Google_Client();
            $client->setClientId(config('services.google.client_id'));
            $client->setClientSecret(config('services.google.client_secret'));
            $client->setRedirectUri(config('services.google.redirect'));

            $code = $request->input('code');

            if ($code) {
                $token = $client->fetchAccessTokenWithAuthCode($code);
                $client->setAccessToken($token['access_token']);
                $oauth2 = new Google_Service_Oauth2($client);
                $userData = $oauth2->userinfo->get();

                // Ở đây, bạn có thể lưu thông tin người dùng vào cơ sở dữ liệu hoặc xử lý theo ý muốn của bạn.

                // Sau đó, bạn có thể trả về thông tin người dùng dưới dạng JSON hoặc làm bất kỳ điều gì bạn muốn.
                return response()->json([
                    'user' => $userData,
                ]);
            } else {
                return ['user' => null]; // Xử lý lỗi nếu cần thiết.
            }
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return $e->getMessage();
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $tokenResult = $user->createToken('MyApp');
            $accessToken = $tokenResult->accessToken;

            $refreshToken = new Token([
                'id' => hash('sha256', Str::random(40)),
                'user_id' => $user["id"],
                'client_id' => 11,
                'name' => 'MyApp',
                'scopes' => [],
                'revoked' => false,
                'expires_at' => now()->addDays(7),
            ]);
            $refreshToken->save();

            return response()->json([
                'data' => $user,
                'token' => 'Bearer ' . $accessToken,
                'refresh_token' => $refreshToken["id"],
            ]);
        }
        // php artisan passport:client --personal  
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    /**
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        $user = Auth::user()->token();
        $user->revoke();
        return response()->json(['message' => 'Logout Success']);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function list(Request $request): JsonResponse
    {
        $data = $this->userService->list($request->all());

        return $this->handleResponse($data);
    }
}
