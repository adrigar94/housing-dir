<?php

namespace App\Auth\User\Domain;
use DateTime;

class User
{
    public function __construct(
        private UserId $id,
        private UserName $name,
        private UserEmail $email,
        private UserPassword $password,
        private DateTime $created_at = new DateTime(),
        private DateTime $updated_at = new DateTime(),
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    public function id(): UserId
    {
        return $this->id;
    }

    public function name(): UserName
    {
        return $this->name;
    }

    public function checkPlainPasswordIsSame(string $plain_password): bool
    {
        return $this->password->checkPlainPasswordIsSame($plain_password);
    }

    public function setPassword(UserPassword $password): void
    {
        $this->password = $password;
    }

    public function email(): UserEmail
    {
        return $this->email;
    }

    public function createdAt(): DateTime
    {
        return $this->created_at;
    }

    public function updatedAt(): DateTime
    {
        return $this->updated_at;
    }

    public function markAsUpdated(): void
    {
        $this->updated_at = new DateTime();
    }
}
