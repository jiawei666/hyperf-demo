<?php

declare(strict_types = 1);

namespace App\Services\OAuth2;

use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Entities\AccessTokenEntityInterface;
use League\OAuth2\Server\Repositories\AccessTokenRepositoryInterface;

class AccessTokenRepository implements AccessTokenRepositoryInterface
{

    /**
     * 生成令牌
     *
     * @param ClientEntityInterface $clientEntity 客户端实体
     * @param array $scopes scope
     * @param null $userIdentifier 用户实体
     * @return AccessTokenEntity|AccessTokenEntityInterface
     */
    public function getNewToken(ClientEntityInterface $clientEntity, array $scopes, $userIdentifier = null)
    {
        return new AccessTokenEntity($clientEntity, $scopes, $userIdentifier);
    }

    /**
     * 生成新令牌后，调用此方法
     *
     * @param AccessTokenEntityInterface $accessTokenEntity
     */
    public function persistNewAccessToken(AccessTokenEntityInterface $accessTokenEntity)
    {
    }

    /**
     * 使用刷新令牌方法生成令牌后，调用此方法
     *
     * @param string $tokenId
     */
    public function revokeAccessToken($tokenId)
    {
    }

    /**
     * 当中间件验证访问令牌时，将调用此方法。
     * 返回true：手动吊销令牌
     * 返回false：牌仍然有效
     *
     * @param string $tokenId
     * @return bool
     */
    public function isAccessTokenRevoked($tokenId)
    {
        return false;
    }
}
