<?php

declare(strict_types = 1);

namespace App\Request\Admin;

use Hyperf\Validation\Rule;
use Hyperf\Validation\Request\FormRequest;

class AuthLoginRequest extends FormRequest
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
            'client_id' => ['required', Rule::in(config('oauth.password.client'))],
            'username'  => 'required|exists:admins,username',
            'password'  => 'required|string',
        ];
    }

    /**
     * 获取已定义验证规则的错误消息.
     */
    public function messages(): array
    {
        return [
            'client_id.required' => '客户端不能为空',
            'client_id.in'       => '客户端错误',
            'username.required'  => '用户名不能为空',
            'username.exists'    => '用户未注册',
            'password.required'  => '密码不能为空',
            'password.string'    => '密码必须是字符',
        ];
    }
}
