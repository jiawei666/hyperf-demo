<?php

declare(strict_types = 1);


namespace App\Services\OAuth2;


use League\OAuth2\Server\Repositories\ClientRepositoryInterface;


class ClientRepository implements ClientRepositoryInterface
{

    public function getClientEntity($clientIdentifier)
    {
        return new ClientEntity($clientIdentifier);
    }

    /**
     * 验证客户端是否合法
     *
     * @param string $clientIdentifier 客户端id
     * @param string|null $clientSecret 客户端秘钥（暂时没用）
     * @param string|null $grantType grantType
     * @return bool
     */
    public function validateClient($clientIdentifier, $clientSecret, $grantType)
    {
        $validClients = config('oauth.password.client');
        if (!in_array($clientIdentifier, $validClients)) {
            return false;
        }

        return true;
    }

}
