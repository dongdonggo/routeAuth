<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;


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
     * @param  \Exception  $exception
     * @return void
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
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {

        if ($e instanceof \HttpResponseException) {
            return parent::render($request, $e);
        } elseif ($e instanceof AuthenticationException) {
           return parent::render($request, $e);
        } elseif ($e instanceof ValidationException) {
            $data =  parent::render($request, $e);
            if ( $request->expectsJson() ) {
                $res =  json_decode($data->getContent(),true);
                $errors['errors'] = $res['errors']; #二维数组
                return returnError($errors, '验证错误', config('code.DATA.data_error'), 422);
            } else {
                return $data;
            }
        }
        return parent::render($request, $e);
    }
}
