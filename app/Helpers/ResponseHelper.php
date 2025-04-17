<?php

namespace App\Helpers;

class ResponseHelper
{
    public static function success($data = null, $statusCode = 200)
    {
        return response()->json([
            'status' => 'success',
            'data' => $data,
            'error' => null
        ], $statusCode);
    }

    public static function fail($message = '', $details = [], $statusCode = 400)
    {
        return response()->json([
            'status' => 'fail',
            'data' => null,
            'error' => [
                'code' => 'FAIL',
                'message' => $message,
                'details' => $details
            ]
        ], $statusCode);
    }

    public static function error($message = '', $code = 'INTERNAL_ERROR', $details = [], $statusCode = 500)
    {
        return response()->json([
            'status' => 'error',
            'data' => null,
            'error' => [
                'code' => $code,
                'message' => $message,
                'details' => $details
            ]
        ], $statusCode);
    }
}
