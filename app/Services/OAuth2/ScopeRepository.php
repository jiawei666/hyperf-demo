<?php

declare(strict_types = 1);


namespace App\Services\OAuth2;


use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Entities\ScopeEntityInterface;
use League\OAuth2\Server\Repositories\ClientRepositoryInterface;
use League\OAuth2\Server\Repositories\ScopeRepositoryInterface;


class ScopeRepository implements ScopeRepositoryInterface
{

    public function getScopeEntityByIdentifier($identifier)
    {
        return new ScopeEntity($identifier);
    }

    /**
     * 验证scope合法性，根据实际情况删减scope（这里不做事情）
     *
     * @param ScopeEntityInterface[] $scopes
     * @param string                 $grantType
     * @param ClientEntityInterface  $clientEntity
     * @param null|string            $userIdentifier
     *
     * @return ScopeEntityInterface[]
     */
    public function finalizeScopes(array $scopes, $grantType, ClientEntityInterface $clientEntity, $userIdentifier = null)
    {

        return $scopes;
    }

}
