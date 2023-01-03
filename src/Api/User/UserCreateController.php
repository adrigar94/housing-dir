<?php

namespace App\Api\User;

use App\Auth\User\Application\Create\UserCreator;
use App\Shared\Infrastructure\Http\Response\ApiResponse;
use App\Auth\User\Domain\UserEmail;
use App\Auth\User\Domain\UserPassword;
use App\Auth\User\Domain\UserId;
use App\Auth\User\Domain\UserName;
use Symfony\Component\HttpFoundation\Request;

class UserCreateController
{

    public function __construct(private UserCreator $creator)
    {
    }

    public function __invoke(Request $request): ApiResponse
    {
        $data = json_decode($request->getContent(), true);
        
        $userId = UserId::random();
        $name = new UserName($data['name']);
        $email = new UserEmail($data['email']);
        $password = UserPassword::createFromPlainTest($data['password']);

        $this->creator->__invoke($userId, $name, $email, $password);

        return ApiResponse::createResponseCreated(
            [
                'status' => 'ok',
                'time' => new \DateTime(),
                'id' => $userId->value()
            ]
        );
    }
}
