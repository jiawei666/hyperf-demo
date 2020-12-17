<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace HyperfTest\Cases;

use AlibabaCloud\Client\AlibabaCloud;
use App\Services\AlibabaCloud\AlibabaCloudApi;
use Hyperf\Testing\Client;
use HyperfTest\HttpTestCase;
use \Defuse\Crypto\Key;
use League\OAuth2\Server\AuthorizationServer;

/**
 * @internal
 * @coversNothing
 */
class ExampleTest extends HttpTestCase
{
    public function testExample()
    {
        $this->assertTrue(true);
        $this->assertTrue(is_array($this->get('/')));
    }
}
