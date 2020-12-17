<?php

declare(strict_types = 1);

namespace App\Controller\Api\Admin;

use App\Model\User;
use App\Middleware\AuthMiddleware;
use App\Resource\Admin\UserResource;
use App\Controller\AbstractController;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\RequestMapping;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Annotation\Middleware;

/**
 * @Middleware(AuthMiddleware::class)
 * @Controller(prefix="api/admin/users")
 */
class UserController extends AbstractController
{
    /**
     * 列表.
     *
     * @RequestMapping(path="", methods="get")
     *
     * @param RequestInterface $request 请求实例
     *
     * @return \Psr\Http\Message\ResponseInterface api资源
     */
    public function index(RequestInterface $request)
    {
        $phone = $request->input('phone');
        $list = User::query()
            ->selectRaw("id, phone, name, gender, created_at, power, pending_power,
            filecoin, pending_filecoin, 'index' as resource_name")
            ->when($phone, function ($q, $value){
                $q->where('phone', 'like', "%{$value}%");
            })
            ->orderByDesc('id')
            ->paginate();

        return UserResource::collection($list)->toResponse();
    }

    /**
     * 详情.
     *
     * @RequestMapping(path="{userId:\d+}", methods="get")
     *
     * @param int $userId 路径参数-公告id
     *
     * @return \Psr\Http\Message\ResponseInterface api资源
     */
    public function show(int $userId)
    {
        $list                = User::query()->find($userId);
        $list->resource_name = 'show';

        return (new UserResource($list))->toResponse();
    }
}
