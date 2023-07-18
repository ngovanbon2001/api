<?php

use App\Constants\Common;
use App\Constants\Constants;

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

        dd($userInfo);
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