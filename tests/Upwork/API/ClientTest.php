<?php
namespace Upwork\API\Tests;

require __DIR__ . '/../../../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use Upwork\API\Debug as ApiDebug;
use Upwork\API\Config as ApiConfig;
use Upwork\API\Client as Client;

class ClientTest extends TestCase
{
    /**
     * @test
     */
    public function testNewClient()
    {
        $config = new ApiConfig(
            array(
                'clientId'      => 'key',
		'clientSecret'	=> 'secret',
		'redirectUri'	=> 'https://a.redirect.url'
            )
        );
        $helper = new Client($config);
        $server = $helper->getServer();

        $this->assertInstanceOf('Upwork\API\AuthTypes\OAuth2ClientLib', $server);
    }

    /**
     * @test
     */
    public function testGetServer()
    {
        $config = new ApiConfig(
            array(
                'clientId'      => 'key',
		'clientSecret'	=> 'secret',
		'redirectUri'	=> 'https://a.redirect.url'
            )
        );
        $reflection = new \ReflectionClass('Upwork\API\Client');
        $property = $reflection->getProperty('_server');
        $property->setAccessible(true);
        $helper = new Client($config);
        $property->setValue($helper, new \StdClass);
        $server = $helper->getServer();

        $this->assertInstanceOf('StdClass', $server);
    }

    /**
     * @test
     */
    public function testAuth()
    {
        $config = new ApiConfig(
            array(
                'clientId'      => 'key',
		'clientSecret'	=> 'secret',
		'redirectUri'	=> 'https://a.redirect.url'
            )
        );
        $reflection = new \ReflectionClass('Upwork\API\Client');
        $property = $reflection->getProperty('_server');
        $property->setAccessible(true);
        $helper = new Client($config);

	$stub = $this->getMockBuilder(stdClass::class)
                     ->setMethods(['option', 'auth'])
                     ->getMock();
        $stub->expects($this->any())
             ->method('option')
             ->will($this->returnValue(true));
        $stub->expects($this->any())
             ->method('auth')
             ->will($this->returnValue('response'));

        $property->setValue($helper, $stub);

        $this->assertEquals('response', $helper->auth());
    }

    /**
     * @test
     */
    public function testRequest()
    {
        $config = new ApiConfig(
            array(
                'clientId'      => 'key',
		'clientSecret'	=> 'secret',
		'redirectUri'	=> 'https://a.redirect.url'
            )
        );
        $reflection = new \ReflectionClass('Upwork\API\Client');
        $property = $reflection->getProperty('_server');
        $property->setAccessible(true);
        $method = $reflection->getMethod('_request');
        $method->setAccessible(true);
        $helper = new Client($config);

	$stub = $this->getMockBuilder(stdClass::class)
                     ->setMethods(['option', 'request'])
                     ->getMock();
        $stub->expects($this->any())
             ->method('option')
             ->will($this->returnValue(true));
        $stub->expects($this->any())
             ->method('request')
             ->will($this->returnValue('{"a": "b"}'));

        $property->setValue($helper, $stub);

        $response = $method->invoke($helper, 'GET', 'http://www.upwork.com/api/auth/v1/info', array());
        $this->assertInstanceOf('StdClass', $response);
        $this->assertObjectHasAttribute('a', $response);
        $this->assertIsString($response->a);
        $this->assertSame('b', $response->a);
    }

    /**
     * @test
     */
    public function testRunMethod()
    {
        $config = new ApiConfig(
            array(
                'clientId'      => 'key',
		'clientSecret'	=> 'secret',
		'redirectUri'	=> 'https://a.redirect.url'
            )
        );

	$stub = $this->getMockBuilder(\Upwork\API\Client::class)
                     ->enableArgumentCloning()
                     ->setConstructorArgs([$config])
                     ->getMock();
        $stub->expects($this->any())
             ->method('get')
             ->will($this->returnValue('response'));
        $stub->expects($this->any())
             ->method('post')
             ->will($this->returnValue('response'));
        $stub->expects($this->any())
             ->method('put')
             ->will($this->returnValue('response'));
        $stub->expects($this->any())
             ->method('delete')
             ->will($this->returnValue('response'));

        foreach (array('get', 'post', 'put', 'delete') as $method) {
            $this->assertEquals('response', $stub->$method('http://', array()));
        }
    }
}
