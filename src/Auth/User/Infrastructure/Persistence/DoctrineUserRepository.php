<?php

namespace App\Auth\User\Infrastructure\Persistence;

use App\Shared\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use App\Auth\User\Domain\UserEmail;
use App\Auth\User\Domain\User;
use App\Auth\User\Domain\UserId;
use App\Auth\User\Domain\UserRepository;

final class DoctrineUserRepository extends DoctrineRepository implements UserRepository
{
    protected static function entityClass(): string
    {
        return User::class;
    }

    public function save(User $user): void
    {
        $this->saveEntity($user);
    }

    public function findById(UserId $id): ?User
    {
        return $this->object_repository->find($id);
    }

    public function findByEmail(UserEmail $email): ?User
    {
        return $this->object_repository->findOneBy(['email'=>$email]);
    }
}
