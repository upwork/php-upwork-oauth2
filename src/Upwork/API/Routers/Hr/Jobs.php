<?php
/**
 * Upwork auth library for using with public API by OAuth
 * Jobs
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
 * Jobs API
 *
 * @link http://developers.upwork.com/Jobs-HR-API
 */
final class Jobs extends ApiClient
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
     * Get list of jobs
     *
     * @param   array $params Parameters
     * @return  object
     */
    public function getList($params)
    {
        ApiDebug::p(__FUNCTION__);
        throw new ApiException('The legacy API was deprecated. Please, use GraphQL call - see example in this library.');
    }

    /**
     * Get specific job by key
     *
     * @param   string $key Job key
     * @return  object
     */
    public function getSpecific($key)
    {
        ApiDebug::p(__FUNCTION__);
        throw new ApiException('The legacy API was deprecated. Please, use GraphQL call - see example in this library.');
    }

    /**
     * Post a new job
     *
     * @param   array $params Parameters
     * @return  object
     */
    public function postJob($params)
    {
        ApiDebug::p(__FUNCTION__);
        throw new ApiException('The legacy API was deprecated. Please, use GraphQL call - see example in this library.');
    }

    /**
     * Edit existend job
     *
     * @param   string $key Job key
     * @param   array $params Parameters
     * @return  object
     */
    public function editJob($key, $params)
    {
        ApiDebug::p(__FUNCTION__);
        throw new ApiException('The legacy API was deprecated. Please, use GraphQL call - see example in this library.');
    }

    /**
     * Delete existend job
     *
     * @param   string $key Job key
     * @param   array $params Parameters
     * @return  object
     */
    public function deleteJob($key, $params)
    {
        ApiDebug::p(__FUNCTION__);
        throw new ApiException('The legacy API was deprecated. Please, use GraphQL call - see example in this library.');
    }
}
