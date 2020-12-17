<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace App\Exception\Handler;

use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\ExceptionHandler\ExceptionHandler;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Hyperf\Utils\Codec\Json;
use Hyperf\Validation\ValidationException;
use Psr\Http\Message\ResponseInterface;
use Throwable;

class AppExceptionHandler extends ExceptionHandler
{
    /**
     * @var StdoutLoggerInterface
     */
    protected $logger;

    public function __construct(StdoutLoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function handle(Throwable $throwable, ResponseInterface $response)
    {
        $this->logger->error(sprintf('%s[%s] in %s', $throwable->getMessage(), $throwable->getLine(), $throwable->getFile()));
        $this->logger->error($throwable->getTraceAsString());

        // 遍历跨域头部配置
        $corsConfigs = config('cors');
        foreach ($corsConfigs as $header => $value) {
            $response = $response->withHeader($header, $value);
        }

        // 表单验证异常处理
        if ($throwable instanceof ValidationException) {
            $this->logger->error($throwable->validator->errors());
            return $response->withStatus(422)
                ->withAddedHeader('content-type', 'application/json; charset=utf-8')
                ->withBody(new SwooleStream(Json::encode(
                    [
                        'message' => $throwable->getMessage(),
                        'errors' => $throwable->validator->errors(),
                    ]
                )));
        }

        $appEnv = env('APP_ENV', 'dev');

        if ($appEnv == 'dev') {
            return $response
                ->withAddedHeader('content-type', 'application/json; charset=utf-8')
                ->withStatus(500)
                ->withBody(new SwooleStream(Json::encode(['message' => $throwable->getMessage(), 'trace' => $throwable->getTrace()])));
        } else {
            return $response->withStatus(500)
                ->withAddedHeader('content-type', 'application/json; charset=utf-8')
                ->withBody(new SwooleStream(Json::encode([
                    'message' => 'Internal Server Error.',
                ])));
        }
    }

    public function isValid(Throwable $throwable): bool
    {
        return true;
    }
}
