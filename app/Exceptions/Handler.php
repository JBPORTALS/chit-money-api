<?php

namespace App\Exceptions;

use App\Helpers\ResponseHelper;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {

        if ($exception instanceof ModelNotFoundException) {
            return ResponseHelper::error('Resource not found', 'NOT_FOUND', $exception->getMessage(), statusCode: 404);
        }

        if ($exception instanceof ValidationException) {
            return ResponseHelper::error('Validation failed', 'VALIDATION_ERROR', $exception->errors(), 422);
        }

        if ($exception instanceof HttpException) {
            return ResponseHelper::error($exception->getMessage() ?: 'HTTP error', $exception->getStatusCode(), $exception->getTrace(), $exception->getStatusCode());
        }

        if ($exception instanceof QueryException) {

            $errorCode = $exception->errorInfo[1];

            if ($errorCode == 1062) {  // Duplicate entry
                return ResponseHelper::error('Duplicate record', 'DATABASE_ERROR', $exception->errorInfo, 409);
            }

            if ($errorCode == 1451) {  // Foreign key constraint

                return ResponseHelper::error('Cannot delete or update due to related records', 'DATABASE_ERROR', $exception->errorInfo, 409);
            }


            return ResponseHelper::error('Database error', 'DATABASE_ERROR', $exception->getMessage(), 500);
        }

        return parent::render($request, $exception);
    }
}
