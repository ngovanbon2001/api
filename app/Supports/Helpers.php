<?php

use App\Constants\Common;
use App\Constants\Constants;
use Illuminate\Support\Facades\Http;

if (!function_exists('handleImage')) {
    function handleImage($fileImage): string
    {
        $imageName = "";

        if ($_FILES['image_url']['name']) {
            $image = $fileImage;
            $imageName = $image->getClientOriginalName();
            $image->move('images',  $imageName);
        }

        return $imageName;
    }
}

if (!function_exists('condition')) {
    function condition(array $conditions): array
    {
       foreach ($conditions as $key => $value) {
            if ($key == Constants::UNSET_CONDITION || in_array($value[2], Constants::UNSET)) {
                unset($conditions[$key]);
            }
       }
       return $conditions;
    }
}

/**
 * Explore Header Token
 */
if (!function_exists('getHeaderToken')) {
    /**
     * @param $request
     * @return string|null
     */
    function getHeaderToken($request): ?string
    {
        $token = $request->header('authorization');
        $result = explode("Bearer", $token);

        return !is_null($token) ? trim($result[1]) : null;
    }
}

/**
 * Get user info from token
 */
if (!function_exists('getUserInfoFromToken')) {
    /**
     * @param $request
     * @return array
     */
    function getUserInfoFromToken($request): array
    {
        $token = explode('.', explode("Bearer", $request)[1])[1];

        $userInfo = json_decode(base64_decode($token), true);

        $userId = null;
        if ($userInfo['role_name'] === Common::ADMIN_ROLE) {
            $userId = $userInfo['driver_id'];
        } elseif ($userInfo['role_name'] === Common::USER_ROLE) {
            $userId = $userInfo['customer_id'];
        }

        return [
            'user_id' => $userId,
            'role' => $userInfo['role_name']
        ];
    }
}

function getInfoUserGoogle($access_token = '')
{
    $Google_userinfo_endpoint = 'https://www.googleapis.com/oauth2/v3/userinfo';
    $scope = 'https://www.googleapis.com/auth/userinfo.email';

    $response = Http::withHeaders([
        'Content-Type' => 'application/json',
        'Authorization' => 'Bearer ' . $access_token,
    ])->get($Google_userinfo_endpoint, [
        'scope' => $scope,
    ]);

    $userinfo = $response->json();

    return [
        'email'         => $userinfo['email']   ?? null,
        'name'          => $userinfo['name']    ?? null,
        'id_google'     => $userinfo['sub']     ?? null,
        'avatar_google' => $userinfo['picture'] ?? null,
    ];
}