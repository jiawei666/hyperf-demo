<?php

declare(strict_types = 1);

namespace App\Controller\Api;

use App\Controller\AbstractController;
use App\Request\UploadImgRequest;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\RequestMapping;
use Hyperf\HttpServer\Contract\ResponseInterface;

/**
 * @Controller(prefix="api/upload")
 */
class UploadController extends AbstractController
{

    /**
     * 通用上传图片方法
     *
     * @RequestMapping(path="img", methods="post")
     *
     * @param UploadImgRequest $request 请求实例
     * @param ResponseInterface $response 返回实例
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function uploadImg(UploadImgRequest $request, ResponseInterface $response)
    {
        $uploadFile = $request->file('file');
        if ($uploadFile->isValid()) {
            // 保存路径
            $relativePath = 'upload/' . date('Ymd');
            $publicPath = 'public/' . $relativePath;
            $absPath = BASE_PATH . '/' . $publicPath;
            if (!dir($absPath)) {
                mkdir($absPath);
            }

            $ext = $uploadFile->getExtension();
            $filename = uniqid() . '.' .$ext; // 生成唯一文件名

            $data = [
                'ext'      => $uploadFile->getExtension(), //getClientOriginalExtension
                'name'     => $uploadFile->getFilename(),
                'mimetype' => $uploadFile->getMimeType(),
                'size'     => $uploadFile->getSize(),
                'path'     => config('file_url') . '/' . $relativePath . '/' . $filename,
            ];
            $uploadFile->moveTo($absPath . '/' . $filename);


            return $this->success(['path' => $data['path']]);
        }

        return $this->failed('上传文件失败！');
    }

}
