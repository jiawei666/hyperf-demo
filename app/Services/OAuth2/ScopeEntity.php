<?php

declare(strict_types = 1);

namespace App\Services\OAuth2;

use League\OAuth2\Server\Entities\ScopeEntityInterface;
use League\OAuth2\Server\Entities\Traits\EntityTrait;

class ScopeEntity implements ScopeEntityInterface
{
    use EntityTrait;

    public function __construct($identifier)
    {
        $this->setIdentifier($identifier);
    }


    public function jsonSerialize ()
    {

    }
}
