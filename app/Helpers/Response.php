<?php

namespace App\Helpers;

class Response
{
    public static function sendValidatorError($data): void
    {
        header('Content-Type: application/json; charset=utf-8');

        http_response_code(422);

        echo json_encode($data);

        die();
    }

    public static function sendNotFoundError(): void
    {
        http_response_code(404);

        echo json_encode([
            'success' => false,
            'error' => "Not found"
        ]);

        die();
    }

    public static function sendServerError()
    {
        http_response_code(500);

        echo json_encode([
            'success' => false,
            'result' => [
                'error' => "Some problems with server"
            ]
        ]);

        die();
    }
}