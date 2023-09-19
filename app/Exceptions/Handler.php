<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {

        $this->renderable(function (NotFoundHttpException $e, $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => __('Record not found.')
                ], 404);
            }
        });
        $this->renderable(function (HttpException $e, $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => __($e->getMessage())
                ], $e->getStatusCode());
            }
        });
    }
    public function render($request, Throwable $exception)
    {
        switch (true) {
            case $exception instanceof NotFoundHttpException:
                return response()->json(['message' => 'Not found', 'status' => false], 404);

            case $exception instanceof AuthenticationException:
                return response()->json(['message' => 'Unauthorized', 'status' => false], 401);
            case $exception instanceof ValidationException:
                $validationErrors = $exception->validator->errors();
                return response()->json(['message' => $exception->getMessage(), 'errors' => $validationErrors, 'status' => false], 422);
            default:
                return response()->json(['message' => 'Internal server error. ' . get_class($exception) . ' - ' . $exception->getMessage()], 500);
        }


    }
}