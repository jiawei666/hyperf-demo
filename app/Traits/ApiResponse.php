<?php
/**
 * api响应封装
 *
 * @author yuanjiawei <957089263@qq.com>
 */

namespace App\Traits;

use Hyperf\HttpServer\Contract\ResponseInterface;

trait ApiResponse
{
    /**
     * @var int HTTP code
     */
    protected $statusCode = 200;
    
    /**
     * @var ResponseInterface
     */
    protected $response;

    /**
     * get the HTTP code
     * @return integer
     */
    private function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * set the HTTP code
     *
     * @param $statusCode
     * @return $this
     */
    private function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * Respond a no content response.
     * 
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function noContent()
    {
        return $this->setStatusCode(204)->response->raw(null)->withStatus($this->getStatusCode());
    }

    /**
     *  Respond a no content response.
     *
     * @param $data
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function respond($data)
    {
        return $this->response->json($data)->withStatus($this->getStatusCode());
    }

    /**
     * Respond a validation error!
     *
     * @param array $error
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function formError($error = [])
    {
        return $this->setStatusCode(422)->respond(['message' => "The given data was invalid.", 'errors' => $error]);
    }



    /**
     * Respond a Request format error!
     *
     * @param $message
     * @param int $code
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function failed($message = 'Request format error!', $code = 400)
    {
        return $this->setStatusCode($code)->respond(['message' => $message]);
    }

    /**
     * Respond a success message!
     *
     * @param string $data
     * @param int $code
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function success($data = 'success', $code = 201)
    {
        $data = is_string($data) ? ['message' => $data] : $data;

        return $this->setStatusCode($code)->respond($data);
    }
    
    /**
     * Respond a not found!
     *
     * @param string $message
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function notFond($message = 'not found!')
    {
        return $this->failed($message, 404);
    }


    /**
     * Respond a Interface requests are too frequent!
     *
     * @param string $message
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function requestsMany($message = 'Interface requests are too frequent!')
    {
        return $this->failed($message, 429);
    }

    /**
     * Respond the error of 'Unauthorized'.
     *
     * @param  string $message
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function errorUnauthorized($message = 'Unauthorized')
    {
        return $this->failed($message, 401);
    }

    /**
     * Respond No access
     *
     * @param string $message
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function notAccess($message = 'No access!')
    {
        return $this->failed($message, 403);
    }

    /**
     * resond a network error!
     *
     * @param string $message
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function internalError($message = "network error!")
    {
        return $this->failed($message, 500);
    }


}
