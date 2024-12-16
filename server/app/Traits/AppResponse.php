<?php

namespace App\Traits;

trait AppResponse
{
    public function successResponse($data, $message = 'Success', $code = 200)
    {
        return response()->json([
           'status' => true,
           'message' => $message,
           'data' => $data,
        ], $code);
    }

    public function errorResponse($message = 'Error', $code = 400)
    {
        return response()->json([
           'status' => false,
           'message' => $message,
        ], $code);
    }

    public function validationErrorResponse($errors)
    {
        return response()->json([
           'status' => false,
           'message' => 'Validation Error',
           'errors' => $errors,
        ], 422);
    }

    
}
