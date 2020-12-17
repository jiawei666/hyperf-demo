<?php

declare(strict_types = 1);

namespace App\Controller\Api\Mobile;

use App\Model\User;
use App\Controller\AbstractController;
use App\Model\VerifyCode;
use App\Request\Mobile\AuthLoginRequest;
use App\Services\OAuth2\PasswordGrant;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\RequestMapping;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;

/**
 * @Controller(prefix="api/mobile/auth")
 */
class AuthController extends AbstractController
{
    /**
     *
     * @RequestMapping(path="login", methods="post")
     *
     * @param AuthLoginRequest  $request  请求实例
     * @param ResponseInterface $response 返回实例
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \League\OAuth2\Server\Exception\OAuthServerException
     */
    public function login(AuthLoginRequest $request, ResponseInterface $response)
    {
        // password grant规定了请求参数，故需要更改请求实体
        // 详情：https://oauth2.thephpleague.com/authorization-server/resource-owner-password-credentials-grant/
        $requestParseBody                  = $request->getParsedBody();
        $requestParseBody['grant_type']    = 'password';
        $requestParseBody['client_secret'] = '';
        $requestParseBody['scope']         = '*';

        if (isset($requestParseBody['phone'])) {
            // 新增或查找user
            $user = User::query()
                ->where('account', $requestParseBody['phone'])
                ->firstOrCreate(
                    ['phone' => $requestParseBody['phone']],
                    ['account' => $requestParseBody['phone'],]
                );

            $requestParseBody['username'] = $user->id;
            $requestParseBody['password'] = '';
        }

        // 生成令牌
        $passwordGrant = new PasswordGrant($request->withParsedBody($requestParseBody), $response);
        $accessTokenInfo = $passwordGrant->getAccessToken();

        // 将验证码设置为无效
        VerifyCode::query()
            ->where('phone', $requestParseBody['phone'])
            ->where('verify_code', $requestParseBody['verify_code'])
            ->update(['valid'=> 0]);

        return $accessTokenInfo;
    }
}
