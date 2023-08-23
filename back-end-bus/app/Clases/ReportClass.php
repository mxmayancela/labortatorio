<?php

namespace App\Clases;

class ReportClass
{
    public function __construct()
    {
        //
    }

    public function responseTo($success, $data, $status, $message, $typeMessage)
    {
        return response()->json([
            'success' => $success,
            'data' => $data,
            'status' => $status,
            'message' => $message,
            'typeMessage' => $typeMessage
        ]);
    }
}