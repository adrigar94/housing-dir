<?php
namespace App\Auth\User\Application\Create;

use App\Auth\User\Domain\UserEmail;
use App\Auth\User\Domain\UserPassword;
use App\Auth\User\Domain\User;
use App\Auth\User\Domain\UserId;
use App\Auth\User\Domain\UserName;
use App\Auth\User\Domain\UserRepository;

final class UserCreator
{
    public function __construct(private UserRepository $repository)
    {
    }

    public function __invoke(
        UserId $id,
        UserName $name,
        UserEmail $email,
        UserPassword $password,
    ): void 
    {
        $user = new User($id, $name, $email, $password);
        $this->repository->save($user);
    }
}
