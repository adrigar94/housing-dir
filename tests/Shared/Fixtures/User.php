<?php

use App\Auth\User\Domain\UserEmail;
use App\Auth\User\Domain\UserId;
use App\Auth\User\Domain\UserName;
use App\Auth\User\Domain\UserPassword;

return [
    'App\Auth\User\Domain\User' => [
        'user1' => [
            '__construct' => [
                'id' => UserId::random(),
                'name' => new UserName('Adrián'),
                'email' => new UserEmail('adri@testing.com'),
                'password' => UserPassword::createFromPlainTest("pass123"),
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ]
        ]
    ],
];