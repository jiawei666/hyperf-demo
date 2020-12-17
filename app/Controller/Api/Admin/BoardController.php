<?php

declare(strict_types = 1);

namespace App\Controller\Api\Admin;

use App\Model\Board;
use App\Middleware\AuthMiddleware;
use App\Resource\Admin\BoardResource;
use App\Controller\AbstractController;
use App\Request\Admin\BoardStoreRequest;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\Middleware;
use Hyperf\HttpServer\Annotation\RequestMapping;
use Hyperf\HttpServer\Contract\RequestInterface;

/**
 * @Middleware(AuthMiddleware::class)
 * @Controller(prefix="api/admin/boards")
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
            ->with('admin')
            ->selectRaw("id, title, admin_id, content, created_at, 'index' as resource_name")
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
        $list                = Board::query()->find($boardId);
        $list->resource_name = 'show';

        return (new BoardResource($list))->toResponse();
    }

    /**
     * 新增.
     *
     * @RequestMapping(path="", methods="post")
     *
     * @param BoardStoreRequest $request 请求实例
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function store(BoardStoreRequest $request)
    {
        $adminId   = $request->getAttribute('oauth_user_id');
        $validData = $request->validated();
        Board::query()->create([
            'title'    => $validData['title'],
            'content'  => $validData['content'],
            'admin_id' => $adminId,
        ]);

        return $this->success('发布成功');
    }

    /**
     * 更新.
     *
     * @RequestMapping(path="{boardId:\d+}", methods="put")
     *
     * @param BoardStoreRequest $request 请求实例
     * @param int               $boardId 路径参数-公告id
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function update(BoardStoreRequest $request, int $boardId)
    {
        $validData = $request->validated();
        Board::query()->where('id', $boardId)->update([
            'title'   => $validData['title'],
            'content' => $validData['content'],
        ]);

        return $this->success('修改成功');
    }

    /**
     * 删除.
     *
     * @RequestMapping(path="{boardId:\d+}", methods="delete")
     *
     * @param int $boardId 路径参数-公告id
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function delete(int $boardId)
    {
        Board::query()->where('id', $boardId)->delete();

        return $this->success('删除成功');
    }
}
