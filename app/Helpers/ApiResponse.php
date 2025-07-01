<?php

namespace App\Helpers;

class ApiResponse
{
    public static function success($message = 'Success', $data = null, $code = 200)
    {
        return response()->json([
            'code' => $code,
            'status' => true,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    public static function error($message = 'Terjadi kesalahan', $errors = null, $code = 500)
    {
        return response()->json([
            'code' => $code,
            'status' => false,
            'message' => $message,
            'errors' => $errors,
        ], $code);
    }
}