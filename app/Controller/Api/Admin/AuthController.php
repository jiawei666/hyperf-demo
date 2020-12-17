<?php

declare(strict_types = 1);

namespace App\Controller\Api\Admin;

use App\Model\Admin;
use App\Controller\AbstractController;
use App\Services\OAuth2\PasswordGrant;
use App\Request\Admin\AuthLoginRequest;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\RequestMapping;
use Hyperf\HttpServer\Contract\ResponseInterface;

/**
 * @Controller(prefix="api/admin/auth")
 */
class AuthController extends AbstractController
{
    /**
     * @RequestMapping(path="login", methods="post")
     *
     * @param AuthLoginRequest  $request  请求实例
     * @param ResponseInterface $response 返回实例
     *
     * @throws \League\OAuth2\Server\Exception\OAuthServerException
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function login(AuthLoginRequest $request, ResponseInterface $response)
    {
        // password grant规定了请求参数，故需要更改请求实体
        // 详情：https://oauth2.thephpleague.com/authorization-server/resource-owner-password-credentials-grant/
        $requestParseBody                  = $request->getParsedBody();
        $requestParseBody['grant_type']    = 'password';
        $requestParseBody['client_secret'] = '';
        $requestParseBody['scope']         = '*';

        if (isset($requestParseBody['username'])) {
            // 新增或查找user
            $admin = Admin::query()->where('username', $requestParseBody['username'])->first();

            if (!password_verify($requestParseBody['password'], $admin->password)) {
                return $this->failed('登录失败，账号或密码错误');
            }
            $requestParseBody['username'] = $admin->id;
        }

        // 生成令牌
        $passwordGrant   = new PasswordGrant($request->withParsedBody($requestParseBody), $response);
        $accessTokenInfo = $passwordGrant->getAccessToken();

        return $accessTokenInfo;
    }
}
