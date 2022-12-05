<?php

namespace App\Auth\User\Application;

use App\Auth\User\Domain\User;
use App\Auth\User\Domain\UserEmail;
use App\Auth\User\Domain\UserPassword;
use App\Auth\User\Domain\UserRepository;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class UserProvider implements UserProviderInterface, PasswordUpgraderInterface
{

    public function __construct(private UserRepository $repository)
    {
    }

    public function refreshUser(UserInterface $user): UserInterface
    {
        if(!$user instanceof User){
            throw new UnsupportedUserException(sprintf("Instace of %s are not supported in refreshUser()", \get_class($user)));
        }
        return $this->loadUserByIdentifier($user->getUserIdentifier());
    }

    public function loadUserByIdentifier(string $identifier): UserInterface
    {
        $email = new UserEmail($identifier);
        $user = $this->repository->findByEmail($email);
        if($user){
            return $user;
        }
        throw new UserNotFoundException(\sprintf("User with email %s not found", $identifier));
    }

    public function supportsClass(string $class): bool
    {
        return $class === User::class;
    }

    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if(!$user instanceof User){
            throw new UnsupportedUserException(sprintf("Instace of %s are not supported in upgradePassword()", \get_class($user)));
        }
        $password = new UserPassword($newHashedPassword);
        $user->setPassword($password);
        $this->repository->save($user);
    }
}
