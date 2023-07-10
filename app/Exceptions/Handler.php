<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;
use App\Supports\RespondResource;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class Handler extends ExceptionHandler
{
    use RespondResource;

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

        /**
     * Render an exception into an HTTP response.
     *
     * @throws Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof MethodNotAllowedHttpException) {
            return $this->fail($exception->getMessage(), ResponseAlias::HTTP_METHOD_NOT_ALLOWED);
        } else if ($exception instanceof ValidationException) {
            $errors = $exception->errors();
            $error = collect($errors)->first();
            $errorStr = $error ? $error[0] : '';
            return $this->fail($errorStr, ResponseAlias::HTTP_BAD_REQUEST);
        } else if ($exception instanceof NotFoundHttpException) {
            return $this->fail('Request not found', ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
        Log::info('[RENDER EXCEPTION] - '.$exception->getMessage());
        return $this->fail($exception->getMessage());
    }
}