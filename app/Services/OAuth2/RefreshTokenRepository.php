<?php

declare(strict_types = 1);

namespace App\Services\OAuth2;

use League\OAuth2\Server\Entities\RefreshTokenEntityInterface;
use League\OAuth2\Server\Repositories\RefreshTokenRepositoryInterface;

class RefreshTokenRepository implements RefreshTokenRepositoryInterface
{
    use \League\OAuth2\Server\Entities\Traits\RefreshTokenTrait;
    use \League\OAuth2\Server\Entities\Traits\EntityTrait;

    /**
     * Creates a new refresh token（暂时不做刷新令牌）.
     *
     * @return RefreshTokenEntityInterface|null
     */
    public function getNewRefreshToken()
    {
        return null;
    }

    public function persistNewRefreshToken(RefreshTokenEntityInterface $refreshTokenEntity)
    {
    }

    public function revokeRefreshToken($tokenId)
    {
    }

    public function isRefreshTokenRevoked($tokenId)
    {
        return false;
    }
}
