<?php

declare(strict_types = 1);

namespace App\Request;

use Hyperf\Validation\Rule;
use Hyperf\Validation\Request\FormRequest;

class UploadImgRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'file' => 'required|image|max:10240',
        ];
    }

    /**
     * 获取已定义验证规则的错误消息.
     */
    public function messages(): array
    {
        return [
            'file.required' => '请上传文件',
            'file.image' => '文件类型必须是图片',
            'file.max' => '文件大小不能超过10M',
        ];
    }
}
