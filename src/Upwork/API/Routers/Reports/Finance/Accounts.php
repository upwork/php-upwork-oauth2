<?php
/**
 * Upwork auth library for using with public API by OAuth
 * Financial Reporting
 *
 * @final
 * @package     UpworkAPI
 * @since       05/02/2014
 * @copyright   Copyright 2014(c) Upwork.com
 * @author      Maksym Novozhylov <mnovozhilov@upwork.com>
 * @license     Upwork's API Terms of Use {@link https://developers.upwork.com/api-tos.html}
 */

namespace Upwork\API\Routers\Reports\Finance;

use Upwork\API\Debug as ApiDebug;
use Upwork\API\Client as ApiClient;
use Upwork\API\ApiException as ApiException;

/**
 * Financial Reporting
 *
 * @link http://developers.upwork.com/Financial-Reports-GDS-API
 */
final class Accounts extends ApiClient
{
    const ENTRY_POINT = UPWORK_GDS_EP_NAME;

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
     * Generate Financial Reports for an owned Account
     *
     * @param   integer $freelancerReference Freelancer reference
     * @param   array $params Parameters
     * @return  object
     */
    public function getOwned($freelancerReference, $params)
    {
        ApiDebug::p(__FUNCTION__);
        throw new ApiException('The legacy API was deprecated. Please, use GraphQL call - see example in this library.');
    }

    /**
     * Generate Financial Reports for a Specific Account
     *
     * @param   integer $entityReference Entity reference
     * @param   array $params Parameters
     * @return  object
     */
    public function getSpecific($entityReference, $params)
    {
        ApiDebug::p(__FUNCTION__);
        throw new ApiException('The legacy API was deprecated. Please, use GraphQL call - see example in this library.');
    }
}
