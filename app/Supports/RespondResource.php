<?php

namespace App\Supports;

use App\Constants\Common;
use App\Constants\StatusCodeMessage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

trait RespondResource
{
 /**
     * Response success
     *
     * @param array|null $data
     * @param string $message
     * @param int $httpCode
     * @param array $headers
     * @param int $options
     * @return JsonResponse
     */
    public function success(array $data = null, string $message = "success",
                            int   $httpCode = Response::HTTP_OK, array $headers = [],
                            int   $options = 0): JsonResponse
    {
        return $this->respond(StatusCodeMessage::CODE_OK, $message, $data, $httpCode, $headers, $options);
    }

    /**
     * Response fail
     *
     * @param string $message
     * @param int $httpCode
     * @param array $headers
     * @param int $options
     * @return JsonResponse
     */
    public function fail(string $message = "fail", int $httpCode = Response::HTTP_EXPECTATION_FAILED,
                         array  $headers = [], int $options = 0): JsonResponse
    {
        return $this->respond(StatusCodeMessage::CODE_FAIL, $message, [], $httpCode, $headers, $options);
    }

    /**
     * Response data empty
     *
     * @param int $codeSystem
     * @param int $httpCode
     * @param array $headers
     * @param int $options
     * @return JsonResponse
     */
    public function dataEmpty(int   $codeSystem, int $httpCode = Response::HTTP_OK,
                              array $headers = [], int $options = 0): JsonResponse
    {
        return $this->respond($codeSystem, StatusCodeMessage::getMessage($codeSystem), [], $httpCode, $headers, $options);
    }

    /**
     * Handle all data respond
     *
     * @param JsonResource|int|array|bool $data
     * @return JsonResponse
     */
    public function handleResponse(JsonResource|int|array|bool $data): JsonResponse
    {
        if (!empty($data) && !is_numeric($data)) {
            $response = [
                'code' => Common::API_CODE_OK,
                'message' => StatusCodeMessage::getMessage(Common::API_CODE_OK),
                'data' => $data
            ];

            return response()->json($response);
//            return $this->success($data);
        } elseif (is_numeric($data)) {
            if (in_array($data, StatusCodeMessage::codeSuccess())) {
                Log::info('codeSuccess');
                Log::info($data);
                return $this->respond($data, StatusCodeMessage::getMessage($data), [], 200, []);
            }
            return $this->respond($data, StatusCodeMessage::getMessage($data), [], 400, []);
        } else {
            Log::info('empty');
            return $this->dataEmpty(StatusCodeMessage::LIST_DATA_EMPTY);
        }
    }

    /**
     * Success response define
     *
     * @param JsonResource|array $data
     * @param int $statusCode
     * @return JsonResponse
     */
    public function apiResponse(
        JsonResource|array $data,
        int                $statusCode = StatusCodeMessage::CODE_OK
    ): JsonResponse
    {
        /**
         * Check response data is empty
         */
//        if ($data instanceof JsonSerializable && ) {
//            $statusCode = StatusCodeMessage::API_CODE_NO_CONTENT;
//            $data = [];
//        }
        $response = [
            'code' => $statusCode,
            'message' => StatusCodeMessage::getMessage($statusCode),
            'data' => $data
        ];

        return response()->json($response);
    }

    public function responseFail($data): JsonResponse
    {
        return $this->respond($data, StatusCodeMessage::getMessage($data), [], 400, []);
    }

    /**
     * Response resource return
     *
     * @param int $code
     * @param string $message
     * @param array|null $data
     * @param int $httpCode
     * @param array $headers
     * @param int $options
     * @return JsonResponse
     */
    public function respond(int $code = 0, string $message = '', array $data = null, int $httpCode = Response::HTTP_OK, array $headers = [], int $options = 0): JsonResponse
    {
        $response = [
            'code' => $code,
            'message' => $message,
            'data' => $data,
        ];

        return response()->json($response, $httpCode, $headers, $options);
    }
}
