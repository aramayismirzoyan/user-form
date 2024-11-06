<?php

namespace App\DTO;

class UserDTO extends BaseDTO
{
    private function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $age,
    ) {}

    public static function create(string $name, string $email, string $age): UserDTO {
        return new self($name, $email, $age);
    }
}