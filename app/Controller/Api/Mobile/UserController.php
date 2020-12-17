<?php

declare(strict_types = 1);

namespace App\Controller\Api\Mobile;

use App\Model\User;
use App\Model\SysConfig;
use App\Middleware\AuthMiddleware;
use App\Controller\AbstractController;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\Middleware;
use Hyperf\HttpServer\Annotation\RequestMapping;
use Hyperf\HttpServer\Contract\RequestInterface;

/**
 * @Middleware(AuthMiddleware::class)
 * @Controller(prefix="api/mobile/users")
 */
class UserController extends AbstractController
{
    /**
     * 列表.
     *
     * @RequestMapping(path="info", methods="get")
     *
     * @param RequestInterface $request 请求实例
     *
     * @return array
     */
    public function info(RequestInterface $request)
    {
        bcscale(9);
        $userId        = $request->getAttribute('oauth_user_id');
        $user          = User::query()->find($userId);
        $config        = SysConfig::query()->where('name', 'dashboard_param')->value('config');
        $filecoinPrice = $config['filecoin_avg_price'] ?? 21.99;

        return [
            'user_id'  => $user->id,
            'phone'    => $user->phone,
            'is_auth'  => $user->is_auth,
            'power'    => $user->power + $user->pending_power,
            'filecoin' => $user->filecoin,
            'usdt'     => bcmul((string) $user->filecoin, (string) $filecoinPrice),
        ];
    }
}
