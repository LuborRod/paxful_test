<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
        $this->renderable(function (MethodNotAllowedHttpException $e, $request) {
            return response()->json($e->getMessage(), 405);
        });
        $this->renderable(function (NotFoundHttpException $e, $request) {
            return response()->json('404 Not found', 404);
        });
        $this->renderable(function (BadRequestHttpException $e, $request) {
            return response()->json($e->getMessage(), 403);
        });
        $this->renderable(function (\Exception $e, $request) {
            return response()->json('Ooops, something went wrong', 400);
        });
    }
}
