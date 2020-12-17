<?php

declare(strict_types=1);
/**
 * 自定义表单验证错误处理中间件
 * @author yuanjiawei <957089263@qq.com>
 *
 */
namespace App\Exception\Handler;

use Hyperf\ExceptionHandler\ExceptionHandler;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Hyperf\Utils\Codec\Json;
use Hyperf\Validation\ValidationException;
use Psr\Http\Message\ResponseInterface;
use Throwable;

class ValidationExceptionHandler extends ExceptionHandler
{
    public function handle(Throwable $throwable, ResponseInterface $response)
    {
        $this->stopPropagation();
        /** @var \Hyperf\Validation\ValidationException $throwable */
//        $body = $throwable->validator->errors()->first();
        $body = Json::encode([
            'message' => 'The given data was invalid.',
            'error' => $throwable->validator->getMessageBag()
        ]);
        return $response->withStatus($throwable->status)
            ->withAddedHeader('content-type', 'application/json; charset=utf-8')
            ->withBody(new SwooleStream($body));
    }

    public function isValid(Throwable $throwable): bool
    {
        return $throwable instanceof ValidationException;
    }
}
