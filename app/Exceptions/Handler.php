<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

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
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     * 
     */
    public function render($request, Exception $exception)
    {
        // Return error as JSON
        if ($request->ajax() || $request->wantsJson()) {
            $code = method_exists($exception, 'getStatusCode') ? $exception->getStatusCode() : 500;
            return response()->json(
                [
                    "success" => false,
                    "code" => $code,
                    "message" => $exception->getMessage()
                ],
                $code
            );
        }

        $code = $exception->getStatusCode();
        return response()->view('error', [
            "code" => $code,
            "message" => $exception->getMessage()
        ], $code);

        // return parent::render($request, $exception);
    }
}
