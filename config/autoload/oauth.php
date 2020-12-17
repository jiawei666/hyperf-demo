<?php

declare(strict_types=1);
/**
 * oauth 配置文件
 */
return [
    'password' => [
        'client' => ['h5', 'admin'],
        'access_token_expire_time' => new \DateInterval('P1D'), // 令牌过期时间：一天，ISO 8601定义的duration格式，详见：https://www.digi.com/resources/documentation/digidocs/90001437-13/reference/r_iso_8601_duration_format.htm
        'refresh_access_token_expire_time' => new \DateInterval('P1M'), // 刷新过期时间：一个月，ISO 8601定义的duration格式，详见：https://www.digi.com/resources/documentation/digidocs/90001437-13/reference/r_iso_8601_duration_format.htm
        'keys' => [
            'private_key' => env('OAUTH_PRIVATE_KEY_PATH', 'private.key'), // 私钥路径
            'public_key' => env('OAUTH_PUBLIC_KEY_PATH', 'public.key'), // 公钥路径
            'encryption_key' => env('OAUTH_ENCRYPTION_KEY', ''), // 随机字符串秘钥
        ],
    ]
];
