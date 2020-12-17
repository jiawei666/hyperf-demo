<?php

declare(strict_types = 1);

namespace App\Request\Admin;

use Hyperf\Validation\Rule;
use Hyperf\Validation\Request\FormRequest;

class BoardStoreRequest extends FormRequest
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
            'title'   => 'required|string|max:20',
            'content' => 'required|string|max:65535',
        ];
    }

    /**
     * 获取已定义验证规则的错误消息.
     */
    public function messages(): array
    {
        return [
            'title.required' => '标题不能为空',
            'title.string' => '标题必须是字符',
            'title.max' => '标题不能超过20个字符（1个汉字占一个字符）',
            'content.required' => '内容不能为空',
            'content.string' => '内容必须是字符',
            'content.max' => '内容超出长度限制',

        ];
    }
}
