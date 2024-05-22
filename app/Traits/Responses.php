<?php

namespace App\Traits;


trait Responses
{
    private static function sendCreated(String $message = '', $data = [])
    {
        return response()->json(['status' => 1, 'message' => $message, 'data' => $data], 201);
    }

    private static function sendSuccess(String $message = '', $data = [])
    {
        return response()->json(['status' => 1, 'message' => $message, 'data' => $data]);
    }

    private static function sendBadRequestError(String $message = '', $data = [], $status = 400)
    {
        return response()->json(['status' => 0, 'message' => $message, 'data' => $data], $status);
    }
}
