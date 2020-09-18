<?php
namespace Upwork\API\Tests\Interfaces;

use PHPUnit\Framework\TestCase;

require __DIR__ . '/../../../../vendor/autoload.php';

class ClientTest extends TestCase
{
    /**
     * @test
     */
    public function testCommon()
    {
        $reflection = new \ReflectionClass('Upwork\API\Interfaces\Client');
        $this->assertTrue($reflection->isInterface());
        $this->assertTrue($reflection->hasMethod('auth'));
        $this->assertTrue($reflection->hasMethod('request'));
    }
}
