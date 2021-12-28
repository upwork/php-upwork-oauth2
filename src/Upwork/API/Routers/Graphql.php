<?php
/**
 * Upwork auth library for using with public API by OAuth
 * GraphQL
 *
 * @final
 * @package     UpworkAPI
 * @since       12/28/2021
 * @copyright   Copyright 2021(c) Upwork.com
 * @author      Maksym Novozhylov <mnovozhilov@upwork.com>
 * @license     Upwork's API Terms of Use {@link https://developers.upwork.com/api-tos.html}
 */

namespace Upwork\API\Routers;

use Upwork\API\Debug as ApiDebug;
use Upwork\API\Client as ApiClient;

/**
 * GraphQL
 *
 * @link https://www.upwork.com/developer/
 */
final class Graphql extends ApiClient
{
    const ENTRY_POINT = UPWORK_GRAPHQL_EP_NAME;

    /**
     * @var Client instance
     */
    private $_client;

    /**
     * Constructor
     *
     * @param   ApiClient $client Client object
     */
    public function __construct(ApiClient $client)
    {
        ApiDebug::p('init ' . __CLASS__ . ' router');
        $this->_client = $client;
        parent::$_epoint = self::ENTRY_POINT;
    }

    /**
     * Execute GraphQL request
     *
     * @param   array $params List of parameters (query and variables)
     * @return object
     */
    public function execute(array $params)
    {
        ApiDebug::p(__FUNCTION__);

        $data = $this->_client->post('', $params);
        ApiDebug::p('found GraphQL data', $data);

        return $data;
    }
}
