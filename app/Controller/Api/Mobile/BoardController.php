<?php

declare(strict_types = 1);

namespace App\Controller\Api\Mobile;

use App\Model\Board;
use App\Controller\AbstractController;
use App\Resource\Mobile\BoardResource;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\RequestMapping;
use Hyperf\HttpServer\Contract\RequestInterface;

/**
 * @Controller(prefix="api/mobile/boards")
 */
class BoardController extends AbstractController
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
        $list = Board::query()
            ->selectRaw("id, title, content, created_at, 'index' as resource_name")
            ->where('status', 1)
            ->orderByDesc('sort')
            ->orderByDesc('id')
            ->paginate();


        return BoardResource::collection($list)->toResponse();
    }

    /**
     * 详情.
     *
     * @RequestMapping(path="{boardId:\d+}", methods="get")
     *
     * @param int $boardId 路径参数-公告id
     *
     * @return \Psr\Http\Message\ResponseInterface api资源
     */
    public function show(int $boardId)
    {
        $list = Board::query()->find($boardId);
        $list->resource_name = 'show';

        return (new BoardResource($list))->toResponse();
    }
}
