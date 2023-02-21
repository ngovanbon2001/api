<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Symfony\Component\HttpFoundation\Response;

class CommonController extends Controller
{
    public static function respond(int $code = 0, string $message = '', $data = null, int $httpCode = Response::HTTP_OK, array $headers = [], int $options = 0)
    {
        $response = [
            'code' => $code,
            'message' => $message,
            'data' => $data,
        ];

        return response()->json($response, $httpCode, $headers, $options);
    }
}
