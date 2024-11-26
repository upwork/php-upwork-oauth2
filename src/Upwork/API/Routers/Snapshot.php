<?php
/**
 * Upwork auth library for using with public API by OAuth
 * Snapshot info
 *
 * @final
 * @package     UpworkAPI
 * @since       05/19/2014
 * @copyright   Copyright 2014(c) Upwork.com
 * @author      Maksym Novozhylov <mnovozhilov@upwork.com>
 * @license     Upwork's API Terms of Use {@link https://developers.upwork.com/api-tos.html}
 */

namespace Upwork\API\Routers;

use Upwork\API\Debug as ApiDebug;
use Upwork\API\Client as ApiClient;
use Upwork\API\ApiException as ApiException;

/**
 * Snapshot info
 *
 * @link http://developers.upwork.com/Snapshot
 */
final class Snapshot extends ApiClient
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
     * Get snapshot info by specific contract
     *
     * @param   string $contractId Contract ID
     * @param   string $ts Timestamp
     * @return  object
     */
    public function getByContract($contractId, $ts)
    {
        ApiDebug::p(__FUNCTION__);
        throw new ApiException('The legacy API was deprecated. Please, use GraphQL call - see example in this library.');
    }

    /**
     * Update snapshot by specific contract
     *
     * @param   string $contractId Contract ID
     * @param   string $ts Timestamp
     * @param   array $params Parameters
     * @return  object
     */
    public function updateByContract($contractId, $ts, $params)
    {
        ApiDebug::p(__FUNCTION__);
        throw new ApiException('The legacy API was deprecated. Please, use GraphQL call - see example in this library.');
    }

    /**
     * Delete snapshot by specific contract
     *
     * @param   string $contractId Contract ID
     * @param   string $ts Timestamp
     * @return  object
     */
    public function deleteByContract($contractId, $ts)
    {
        ApiDebug::p(__FUNCTION__);
        throw new ApiException('The legacy API was deprecated. Please, use GraphQL call - see example in this library.');
    }
}
