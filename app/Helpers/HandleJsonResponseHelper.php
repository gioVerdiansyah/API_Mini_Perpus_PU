<?php
namespace App\Helpers;

class HandleJsonResponseHelper
{
    private static array $struct = [];
    private static int $statusCode;
    public static function res(string $message, mixed $data = [], int $statusCode = 200, bool $status = true)
    {
        self::$struct = [
            'meta' => [
                'success' => $status,
                'message' => $message,
                'status' => $statusCode
            ],
            'data' => $data
        ];
        self::$statusCode = $statusCode;

        return response()->json(self::$struct, self::$statusCode);
    }
}
