<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;
use App\Exceptions\CustomException;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response|\Illuminate\Http\JsonResponse
     */
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof CustomException) {
            return $this->handleCustomException($exception);
        }

        return parent::render($request, $exception);
    }

    /**
     * Handle the CustomException.
     *
     * @param  \App\Exceptions\CustomException  $exception
     * @return \Illuminate\Http\JsonResponse
     */
    private function handleCustomException(CustomException $exception): JsonResponse
    {
        // Log the exception or perform any other necessary actions

        $message = $exception->getMessage();
        $statusCode = $exception->getCode() ?: 500;

        return response()->json(['message' => $message], $statusCode);
    }
}
