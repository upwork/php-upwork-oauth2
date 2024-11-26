<?php
/**
 * Upwork auth library for using with public API by OAuth
 * Contracts
 *
 * @final
 * @package     UpworkAPI
 * @since       05/09/2014
 * @copyright   Copyright 2014(c) Upwork.com
 * @author      Maksym Novozhylov <mnovozhilov@upwork.com>
 * @license     Upwork's API Terms of Use {@link https://developers.upwork.com/api-tos.html}
 */

namespace Upwork\API\Routers\Hr;

use Upwork\API\Debug as ApiDebug;
use Upwork\API\Client as ApiClient;
use Upwork\API\ApiException as ApiException;

/**
 * Contracts API
 *
 * @link http://developers.upwork.com/w/page/46842954/Contracts%20API
 */
final class Contracts extends ApiClient
{
    const ENTRY_POINT = UPWORK_API_EP_NAME;

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
     * Suspend Contract
     *
     * @param   integer $reference Contract reference
     * @param   array $params Parameters
     * @return  object
     */
    public function suspendContract($reference, $params)
    {
        ApiDebug::p(__FUNCTION__);
        throw new ApiException('The legacy API was deprecated. Please, use GraphQL call - see example in this library.');
    }

    /**
     * Restart Contract
     *
     * @param   integer $reference Contract reference
     * @param   array $params Parameters
     * @return  object
     */
    public function restartContract($reference, $params)
    {
        ApiDebug::p(__FUNCTION__);
        throw new ApiException('The legacy API was deprecated. Please, use GraphQL call - see example in this library.');
    }

    /**
     * End Contract
     *
     * @param   integer $reference Contract reference
     * @param   array $params Parameters
     * @return  object
     */
    public function endContract($reference, $params)
    {
        ApiDebug::p(__FUNCTION__);
        throw new ApiException('The legacy API was deprecated. Please, use GraphQL call - see example in this library.');
    }
}
