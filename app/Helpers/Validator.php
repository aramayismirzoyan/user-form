<?php

namespace App\Helpers;

use App\DTO\DTO;
use App\Repositories\UserRepository;

class Validator
{
    private array $errors = [];
    private readonly array $params;

    public function __construct(DTO $dto)
    {
        $this->params = $dto->toArray();
    }

    private function hasField($field): bool
    {
        if(isset($this->params[$field])) {
            return !empty($this->params[$field]);
        }

        return false;
    }

    private function addError($field, $error): void
    {
        $this->errors[$field][] = $error;
    }

    public function setRequired($field): void
    {
        if(!$this->hasField($field)) {
            $this->addError($field, 'Поле обязательное');
        }
    }

    public function setAsEmail($field): void
    {
        if(!$this->hasField($field)) return;

        if(!filter_var($this->params[$field], FILTER_VALIDATE_EMAIL)) {
            $this->addError($field, 'Введите правильную почту');
        }
    }

    public function setAsInt($field) :void
    {
        if(!$this->hasField($field)) return;

        if(!filter_var($this->params[$field], FILTER_VALIDATE_INT)) {
            $this->addError($field, "Это поле должно быть целое число");
        }
    }

    public function setLength($field, $length): void
    {
        if(!$this->hasField($field)) return;

        if(strlen($this->params[$field]) > $length) {
            $this->addError($field, "Длина поля не больше $length символов");
        }
    }

    public function isUniqEmail()
    {
        if(!$this->hasField('email')) return;

        if(!UserRepository::isUniqEmail($this->params['email'])) {
            $this->addError('email', "Уже есть пользователь с такой почтой");
        }
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public  function validate(): bool
    {
        return empty($this->errors);
    }

    public function getSafeData(): array
    {
        if(!$this->validate()) return [];

        return array_map(function ($value) {
            return htmlspecialchars(trim($value));
        }, $this->params);
    }
}