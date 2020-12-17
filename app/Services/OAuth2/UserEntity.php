<?php

declare(strict_types = 1);

namespace App\Services\OAuth2;

use League\OAuth2\Server\Entities\Traits\EntityTrait;
use League\OAuth2\Server\Entities\UserEntityInterface;

class UserEntity implements UserEntityInterface
{
    use EntityTrait;

    public function __construct($userId)
    {
        $this->setIdentifier($userId);
    }


}
