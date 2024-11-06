<?php

namespace App\DTO;

class BaseDTO implements DTO
{
    public function toArray(): array
    {
        return get_object_vars($this);
    }
}