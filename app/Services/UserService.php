<?php

namespace App\Services;

use App\DTO\UserDTO;
use App\Helpers\Request;
use App\Helpers\Validator;

class UserService
{
    public function getAddUserValidator($data): Validator
    {
        $userDTO = UserDTO::create(
            Request::getParam($data, 'name'),
            Request::getParam($data, 'email'),
            Request::getParam($data, 'age'),
        );

        $validator = new Validator($userDTO);

        $validator->setRequired('name');
        $validator->setRequired('email');
        $validator->setRequired('age');

        $validator->setLength('name', 50);
        $validator->setAsEmail('email');
        $validator->setAsInt('age');
        $validator->isUniqEmail();

        return $validator;
    }
}