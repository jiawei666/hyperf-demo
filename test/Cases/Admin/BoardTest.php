<?php

declare(strict_types = 1);
/**
 * 公告测试用例.
 */

namespace HyperfTest\Cases\Admin;

use Hyperf\Testing\Client;
use HyperfTest\HttpTestCase;

/**
 * @internal
 * @coversNothing
 */
class BoardTest extends HttpTestCase
{
    public $accessToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiJhZG1pbiIsImp0aSI6IjI1M2ExYzI3ODY4NzBiNTgxNzI4OGRmMGQ3YTBlNmVjYjJhYjViMjA3NzM4NjJhMDFhNDUxMjFiZmYyZTdjMTMxODZmOTE1MjdjZjQ3OWFlIiwiaWF0IjoxNjA3NjgzNzk2LCJuYmYiOjE2MDc2ODM3OTYsImV4cCI6MTYwNzc3MDE5Niwic3ViIjoiMSIsInNjb3BlcyI6W119.iDZKcj8IwJiBD-C2Mk30LB7MrbrpwIAz1QYE2irz_C3H6_qg7XlvcZKrcNYEWZGbnp9mIlSYvHrUudH7kWakSqFkbvRAZi5PUtaD5VsCnUoTp5UY4A4a6NlfntnGeT3S24eBLmCcJgiHPZXK_MxuEytCxkRB8qEG5psipRByqamuUQp4XXABrsILSaO96NKCl_PKhUROF84fMsITDFXHUQKpFMo5We96h_ZqNFBZLr1MEiwQOqCnLTt_8GTbONJ22dJkeezJ6C4uHpzSfC4qMYPA7Vdsg6hDw0Xbu2-vRBmI0QjysLkhFL_kejZ2Q76j2S9Ton8I8UQojJiy5YRPYw';

    /**
     * 列表.
     */
    public function testAdminBoardIndex()
    {
        $client = make(Client::class);
        $result = $client->get('/api/admin/boards', [], []);

        $this->assertArrayHasKey('data', $result);
    }

    /**
     * 生成.
     */
    public function testAdminPowerDetailStore()
    {
        $client = make(Client::class);
        $result = $client->post('/api/admin/boards/1', [
            'user_id' => 1,
            'amount'  => 5,
        ], [
            'Authorization' => "Bearer {$this->accessToken}}",
        ]);


        $this->assertArrayHasKey('message', $result);
        $this->assertArrayNotHasKey('error', $result);
    }

    /**
     * 删除.
     */
    public function testAdminPowerDetailDelete()
    {
        $client = make(Client::class);
        $result = $client->delete('/api/admin/boards/1', [], [
            'Authorization' => "Bearer {$this->accessToken}}",
        ]);

        $this->assertArrayHasKey('message', $result);
        $this->assertArrayNotHasKey('error', $result);
    }
}
