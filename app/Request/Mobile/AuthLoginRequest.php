<?php

declare(strict_types = 1);

namespace App\Request\Mobile;

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
            'client_id'   => ['required', Rule::in(config('oauth.password.client'))],
            'phone'       => 'required|cn_phone',
            'verify_code' => [
                'required',
                Rule::exists('verify_codes')
                    ->where('phone', $this->input('phone'))
                    ->where('verify_code', $this->input('verify_code'))
                    ->where('valid', 1)
                    ->where(function ($q) {
                        $q->where('expire_at', '>=', date('Y-m-d H:i:s'));
                    })
            ],
        ];
    }

    /**
     * 获取已定义验证规则的错误消息.
     */
    public function messages(): array
    {
        return [
            'client_id.required'   => '客户端不能为空',
            'client_id.in'         => '客户端错误',
            'phone.required'       => '手机号不能为空',
            'phone.cn_phone'       => '手机号格式错误',
            'verify_code.required' => '验证码不能为空',
            'verify_code.exists'   => '验证码错误或已过期',
        ];
    }
}
