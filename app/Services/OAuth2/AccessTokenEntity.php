<?php

declare(strict_types = 1);

namespace App\Services\OAuth2;

use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Entities\AccessTokenEntityInterface;

class AccessTokenEntity implements AccessTokenEntityInterface
{
    use \League\OAuth2\Server\Entities\Traits\AccessTokenTrait;
    use \League\OAuth2\Server\Entities\Traits\EntityTrait;
    use \League\OAuth2\Server\Entities\Traits\TokenEntityTrait;

    /**
     * 初始化令牌参数.
     *
     * AccessTokenEntity constructor.
     *
     * @param ClientEntityInterface $clientEntity   客户端实体
     * @param array                 $scopes         scopes列表
     * @param null                  $userIdentifier 用户实体
     */
    public function __construct(ClientEntityInterface $clientEntity, array $scopes, $userIdentifier = null)
    {
        // 设置令牌user_id
        $this->setUserIdentifier($userIdentifier);
        // 设置令牌客户端id
        $this->setClient($clientEntity);
    }
}
