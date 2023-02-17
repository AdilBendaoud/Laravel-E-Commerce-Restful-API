<?php

namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
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
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        if ($request->expectsJson()) {
            if ($exception instanceof ModelNotFoundException) {
                return response()->json([
                    'error' => 'Resource not found'
                ], Response::HTTP_NOT_FOUND);
            } elseif ($exception instanceof AuthorizationException) {
                return response()->json([
                    'error' => 'Unauthorized'
                ], Response::HTTP_FORBIDDEN);
            } elseif ($exception instanceof ValidationException) {
                return response()->json([
                    'error' => $exception->getMessage()
                ], Response::HTTP_BAD_REQUEST);
            } elseif ($exception instanceof NotFoundHttpException) {
                return response()->json([
                    'error' => "route not found"
                ], Response::HTTP_NOT_FOUND);
            }
        }
        return parent::render($request, $exception);

    }
}