<?php
namespace Upwork\API\Tests\Routers;

require_once __DIR__  . '/CommonTestRouter.php';

class GraphqlTest extends CommonTestRouter
{
    /**
     * Setup
     */
    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @test
     */
    public function testExecute()
    {
        $router = new \Upwork\API\Routers\Graphql($this->_client);
        $response = $router->Execute(array('query' => 'query{}'));
        
        $this->_checkResponse($response);
    }
}
