<?php

namespace App\Exceptions;

use Throwable;
use Inertia\Inertia;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;

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
        // $this->renderable(function (\Spatie\Permission\Exceptions\UnauthorizedException $e, $request) {
        //     return response()->json([
        //         'responseMessage' => __('You do not have the required authorization.'),
        //         'responseStatus'  => 403,
        //     ]);
        // });

        // $this->renderable(function (\Spatie\Permission\Exceptions\UnauthorizedException $e, $request) {
        //     //dd($e);
        //     return Inertia::render('Error',
        //         [
        //             'statusCode' => $e->getStatusCode(),
        //             'message' => __($e->getMessage()),
        //         ]);
        // });

        $this->renderable(function (HttpException $e, $request) {
            return Inertia::render('Error/Error'.$e->getStatusCode(),
                [
                    'statusCode' => $e->getStatusCode(),
                    'message' => __($e->getMessage()),
                    'appname'        => config('app.name')
                ]);
            // return response()->view('errors.minimal', [
            //     'statusCode' => $e->getStatusCode(),
            //     'message' => __($e->getMessage()),
            // ], $e->getStatusCode());
        });

        $this->reportable(function (Throwable $e) {


        });
    }
}
