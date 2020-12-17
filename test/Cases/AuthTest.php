<?php

declare(strict_types = 1);
/**
 * 授权认证测试用例
 */
namespace HyperfTest\Cases;

use Hyperf\Testing\Client;
use HyperfTest\HttpTestCase;

/**
 * @internal
 * @coversNothing
 */
class AuthTest extends HttpTestCase
{
    /**
     * 验证码登录
     */
    public function testLogin()
    {
        $client = make(Client::class);
        $result = $client->post('/api/mobile/auth/login', [
            'client_id'     => 'h5',
            'phone'         => '13672387540',
            'verify_code'   => '6121',
        ]);


        $this->assertArrayHasKey('token_type', $result);
        $this->assertArrayHasKey('expires_in', $result);
        $this->assertArrayHasKey('access_token', $result);
    }
}
