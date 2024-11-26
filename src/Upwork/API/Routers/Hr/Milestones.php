<?php
/**
 * Upwork auth library for using with public API by OAuth
 * Work with Milestones
 *
 * @final
 * @package     UpworkAPI
 * @since       11/17/2014
 * @copyright   Copyright 2014(c) Upwork.com
 * @author      Maksym Novozhylov <mnovozhilov@upwork.com>
 * @license     Upwork's API Terms of Use {@link https://developers.upwork.com/api-tos.html}
 */

namespace Upwork\API\Routers\Hr;

use Upwork\API\Debug as ApiDebug;
use Upwork\API\Client as ApiClient;
use Upwork\API\ApiException as ApiException;

/**
 * Milestones
 *
 * @link https://developers.upwork.com/?lang=php#contracts-and-offers
 */
final class Milestones extends ApiClient
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
     * Get active Milestone for specific Contract
     *
     * @param   integer $contractId Contract reference
     * @return  object
     */
    public function getActiveMilestone($contractId)
    {
        ApiDebug::p(__FUNCTION__);
        throw new ApiException('The legacy API was deprecated. Please, use GraphQL call - see example in this library.');
    }

    /**
     * Get all Submissions for specific Milestone
     *
     * @param   integer $milestoneId Milestone ID
     * @return  object
     */
    public function getSubmissions($milestoneId)
    {
        ApiDebug::p(__FUNCTION__);
        throw new ApiException('The legacy API was deprecated. Please, use GraphQL call - see example in this library.');
    }

    /**
     * Create a new Milestone
     *
     * @param   array $params Parameters
     * @return  object
     */
    public function create($params)
    {
        ApiDebug::p(__FUNCTION__);
        throw new ApiException('The legacy API was deprecated. Please, use GraphQL call - see example in this library.');
    }

    /**
     * Edit an existing Milestone
     *
     * @param   integer $milestoneId Milestone ID
     * @param   array $params Parameters
     * @return  object
     */
    public function edit($milestoneId, $params)
    {
        ApiDebug::p(__FUNCTION__);
        throw new ApiException('The legacy API was deprecated. Please, use GraphQL call - see example in this library.');
    }

    /**
     * Activate an existing Milestone
     *
     * @param   integer $milestoneId Milestone ID
     * @param   array $params Parameters
     * @return  object
     */
    public function activate($milestoneId, $params)
    {
        ApiDebug::p(__FUNCTION__);
        throw new ApiException('The legacy API was deprecated. Please, use GraphQL call - see example in this library.');
    }

    /**
     * Approve an existing Milestone
     *
     * @param   integer $milestoneId Milestone ID
     * @param   array $params Parameters
     * @return  object
     */
    public function approve($milestoneId, $params)
    {
        ApiDebug::p(__FUNCTION__);
        throw new ApiException('The legacy API was deprecated. Please, use GraphQL call - see example in this library.');
    }

    /**
     * Delete an existing Milestone
     *
     * @param   integer $milestoneId Milestone ID
     * @return  object
     */
    public function deleteMilestone($milestoneId)
    {
        ApiDebug::p(__FUNCTION__);
        throw new ApiException('The legacy API was deprecated. Please, use GraphQL call - see example in this library.');
    }
}
