<?php

namespace App;

use App\Helpers\Request;
use App\Helpers\Response;
use App\Repositories\UserRepository;
use App\Services\UserService;
use Providers\ViewProvider;

class UserController
{
    public function index()
    {
        ViewProvider::show('index', [
            'users' => UserRepository::getAll()
        ]);
    }

    public function create()
    {
        $data = Request::getPost();

        $validator = (new UserService)->getAddUserValidator($data);

        if(!$validator->validate()) {
            Response::sendValidatorError([
                'success' => false,
                'errors' => $validator->getErrors()
            ]);
        }

        $userRepository = new UserRepository();

        if($userRepository->add($validator->getSafeData())) {
            ViewProvider::show('components/user_table', [
                'users' => UserRepository::getAll()
            ]);
        }

        Response::sendServerError();
    }
}