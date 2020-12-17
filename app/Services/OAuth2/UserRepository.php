<?php

declare(strict_types = 1);

namespace App\Services\OAuth2;

use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Repositories\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function getUserEntityByUserCredentials(
        $userId,
        $password,
        $grantType,
        ClientEntityInterface $clientEntity
    ) {
        return new UserEntity($userId);
    }
}
