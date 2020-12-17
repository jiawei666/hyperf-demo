<?php

declare(strict_types = 1);

namespace App\Middleware;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use App\Services\OAuth2\AccessTokenRepository;
use Hyperf\HttpServer\Contract\RequestInterface;
use League\OAuth2\Server\Exception\OAuthServerException;
use Hyperf\HttpServer\Contract\ResponseInterface as HttpResponse;

class AuthMiddleware implements MiddlewareInterface
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @var HttpResponse
     */
    protected $response;

    public function __construct(ContainerInterface $container, HttpResponse $response, RequestInterface $request)
    {
        $this->container = $container;
        $this->response  = $response;
        $this->request   = $request;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        // 初始化令牌仓库
        $accessTokenRepository = new AccessTokenRepository();

        // 公钥路径
        $publicKeyPath = env('OAUTH_PUBLIC_KEY_PATH');

        // 设置auth server
        $server = new \League\OAuth2\Server\ResourceServer(
            $accessTokenRepository,
            $publicKeyPath
        );

        // 验证auth
        try {
            $request = $server->validateAuthenticatedRequest($request);
            $routeClient = 'h5';
            if ($this->request->is('api/admin/*')) {
                $routeClient = 'admin';
            }

            if ($request->getAttribute('oauth_client_id') != $routeClient) {
                return $this->response->json(['message' => '客户端不匹配！'])->withStatus(403);
            }
        } catch (OAuthServerException $exception) {
            return $this->response->json(['message' => '抱歉，无操作权限！'])->withStatus(403);
        } catch (\Exception $exception) {
            return $this->response->json(['message' => $exception->getMessage()])->withStatus(500);
        }
        return $handler->handle($request);
    }
}
