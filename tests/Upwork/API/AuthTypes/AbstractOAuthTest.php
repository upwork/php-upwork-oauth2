<?php
namespace Upwork\API\Tests\AuthTypes;

require __DIR__ . '/../../../../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use Upwork\API\AuthTypes\AbstractOAuth as AbstractOAuth;

class AbstractOAuthTest extends TestCase
{
    /**
     * @test
     */
    public function testSetOption()
    {
        $stub = $this->getMockForAbstractClass(
            'Upwork\API\AuthTypes\AbstractOAuth',
            array('key', 'secret', 'http://a.callback.url')
        );

        $reflection = new \ReflectionClass($stub);
        $property = $reflection->getProperty('_state');
        $property->setAccessible(true);
        $before = $property->getValue($property);
        
        $stub->option('state', '12345asdf');
        $after = $property->getValue('state');

        $this->assertEquals(null, $before);
	$this->assertEquals('12345asdf', $after);
    }

    /**
     * @test
     */
    public function testAuth()
    {
        $stub = $this->getMockForAbstractClass(
            'Upwork\API\AuthTypes\AbstractOAuth',
            array('key', 'secret', 'https://a.callback.url')
        );
        
        $reflection = new \ReflectionClass($stub);
        $property = $reflection->getProperty('_authzCode');
        $property->setAccessible(true);
        $property->setValue('authzCode');

        $property = $reflection->getProperty('_accessToken');
        $property->setAccessible(true);
        $property->setValue('accesstoken');
        $property = $reflection->getProperty('_refreshToken');
        $property->setAccessible(true);
        $property->setValue('refreshtoken');
        $property = $reflection->getProperty('_expiresIn');
        $property->setAccessible(true);
        $property->setValue(9999999999);
        
        
        $response = $stub->auth();
        $this->assertArrayHasKey('access_token', $response);
        $this->assertArrayHasKey('refresh_token', $response);
        $this->assertArrayHasKey('expires_in', $response);
        $this->assertEquals('accesstoken', $response['access_token']);
        $this->assertEquals('refreshtoken', $response['refresh_token']);
        $this->assertEquals('9999999999', $response['expires_in']);
    }

    /**
     * @test
     */
    public function testGetOAuthInstance()
    {
        $stub = $this->getMockForAbstractClass(
            'Upwork\API\AuthTypes\AbstractOAuth',
            array('key', 'secret', 'https://a.callback.url')
        );
        $stub->expects($this->any())
             ->method('_getOAuthInstance')
             ->will($this->returnValue(true));

        $reflection = new \ReflectionClass($stub);
        $method = $reflection->getMethod('_getOAuthInstance');
        $method->setAccessible(true);

        $this->assertTrue($method->invoke($stub, array()));
    }

    /**
     * @test
     */
    public function testSetupAccessToken()
    {
        $stub = $this->getMockForAbstractClass(
            'Upwork\API\AuthTypes\AbstractOAuth',
            array('key', 'secret')
        );
        $stub->expects($this->any())
             ->method('_setupTokens')
             ->will($this->returnValue(true));

        $reflection = new \ReflectionClass($stub);
        $method = $reflection->getMethod('_setupTokens');
        $method->setAccessible(true);

        $this->assertTrue($method->invoke($stub, array()));
    }

    /**
     * @test
     * @expectedException Upwork\API\ApiException
     */
    public function testNoKeySpecified()
    {
        $this->expectException(\Upwork\API\ApiException::class);
        $stub = $this->getMockForAbstractClass(
            'Upwork\API\AuthTypes\AbstractOAuth',
            array(null, 'secret')
        );
        $stub->expects($this->any())
             ->method('_construct')
             ->will($this->returnValue(true));
    }

    /**
     * @test
     * @expectedException Upwork\API\ApiException
     */
    public function testNoSecretSpecified()
    {
        $this->expectException(\Upwork\API\ApiException::class);
        $stub = $this->getMockForAbstractClass(
            'Upwork\API\AuthTypes\AbstractOAuth',
            array('key', null)
        );
        $stub->expects($this->any())
             ->method('_construct')
             ->will($this->returnValue(true));
    }
}
