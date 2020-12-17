<?php

declare(strict_types=1);
/**
 * 跨域 配置文件
 */
return [
    'Access-Control-Allow-Origin' => '*',
    'Access-Control-Allow-Headers' => 'DNT,Keep-Alive,User-Agent,Cache-Control,Content-Type,Authorization,X-Requested-With,Origin,Access-Toke,Cookie,X-CSRF-TOKEN,Accept,X-XSRF-TOKEN',
    'Access-Control-Expose-Headers' => 'Authorization, authenticated',
    'Access-Control-Allow-Methods' => 'GET, POST, PATCH, PUT, OPTIONS, DELETE',
    'Access-Control-Allow-Credentials' => 'true',
];
