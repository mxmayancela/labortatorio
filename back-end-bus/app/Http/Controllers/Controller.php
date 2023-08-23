<?php

namespace App\Http\Controllers;

use App\Traits\ResponseFormatTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests, ResponseFormatTrait;

    protected function responseTo(
        bool $success, $data = null, int $status = 200, string $message = null, bool $sendAlert = false,
        mixed $error = null, string $typeMessage = null
    ): JsonResponse
    {
        return ResponseFormatTrait::responseTo(
            success: $success,
            data: $data,
            status: $status,
            message: $message,
            sendAlert: $sendAlert,
            error: $error,
            typeMessage: $typeMessage);
    }
}
