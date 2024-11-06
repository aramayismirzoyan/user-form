<?php

namespace App\Helpers;

class Request
{
    public static function getParam($data, $key)
    {
        return $data[$key] ?? '';
    }

    public static function getPost()
    {
        return $_POST;
    }

    public static function isValidType($type): bool
    {
        return $_SERVER['REQUEST_METHOD'] === $type;
    }
}