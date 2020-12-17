<?php

declare(strict_types = 1);

namespace App\Services\OAuth2;

use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Entities\Traits\ClientTrait;
use \League\OAuth2\Server\Entities\Traits\EntityTrait;

class ClientEntity implements ClientEntityInterface
{
    use ClientTrait,EntityTrait;
    public function __construct($identifier)
    {
        $this->setIdentifier($identifier);
    }
}
