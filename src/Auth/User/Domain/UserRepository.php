<?php

namespace App\Auth\User\Domain;

interface UserRepository
{
    public function save(User $user): void;
    public function findById(UserId $id): ?User;
    public function findByEmail(UserEmail $email): ?User;
}
