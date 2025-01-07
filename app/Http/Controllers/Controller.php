<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function NotifiSuccess($message)
    {
        return response()->json([
            'status' => true,
            'messages' => $message,
        ]);
    }

    public function ResData($data)
    {
        return response()->json([
            'data' => $data,
        ]);
    }
}
