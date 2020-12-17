<?php

declare(strict_types = 1);
/**
 * oauth密码授权类.
 *
 * @author yuanjw <957089263@qq.com>
 */

namespace App\Services\OAuth2;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class PasswordGrant
{
    private $privateKey;
    private $encryptionKey;
    private $accessTokenExpireTime;
    private $refreshAccessTokenExpireTime;

    /** @var ServerRequestInterface 请求实例 */
    private $request;
    /** @var ResponseInterface 返回实例 */
    private $response;

    /**
     * PasswordGrant constructor.
     * @param ServerRequestInterface $request 请求实例
     * @param ResponseInterface $response 返回实例
     */
    public function __construct(ServerRequestInterface $request, ResponseInterface $response)
    {
        // 初始化
        $this->privateKey = config('oauth.password.keys.private_key'); // 私钥路径
        //$privateKey = new CryptKey('file://path/to/private.key', 'passphrase'); // 私钥密码（需要的话）
        $this->encryptionKey                = config('oauth.password.keys.encryption_key'); // 随机加密字符串
        $this->accessTokenExpireTime        = config('oauth.password.access_token_expire_time'); // 令牌过期时间
        $this->refreshAccessTokenExpireTime = config('oauth.password.refresh_access_token_expire_time'); // 刷新令牌过期时间

        $this->request  = $request;
        $this->response = $response;
    }

    /**
     * 获取access_token
     *
     * @throws \League\OAuth2\Server\Exception\OAuthServerException
     *
     * @return ResponseInterface
     */
    public function getAccessToken()
    {
        $clientRepository       = new ClientRepository(); // 实例化仓库实例
        $scopeRepository        = new ScopeRepository(); // scopes仓库实例
        $accessTokenRepository  = new AccessTokenRepository(); // 令牌仓库实例
        $userRepository         = new UserRepository(); // 用户仓库实例
        $refreshTokenRepository = new RefreshTokenRepository(); // 刷新令牌仓库实例

        // 初始化server
        $server = new \League\OAuth2\Server\AuthorizationServer(
            $clientRepository,
            $accessTokenRepository,
            $scopeRepository,
            $this->privateKey,
            $this->encryptionKey
        );

        // 实例化password grant
        $grant = new \League\OAuth2\Server\Grant\PasswordGrant(
            $userRepository,
            $refreshTokenRepository
        );

        // 设置刷新令牌过期时间
        $grant->setRefreshTokenTTL($this->refreshAccessTokenExpireTime);

        // 在server上开启password grant
        $server->enableGrantType(
            $grant,
            $this->accessTokenExpireTime // 令牌过期时间
        );

        return $server->respondToAccessTokenRequest($this->request, $this->response);
    }
}
