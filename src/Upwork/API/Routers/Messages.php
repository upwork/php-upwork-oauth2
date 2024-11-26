<?php
/**
 * Upwork auth library for using with public API by OAuth
 *
 * @final
 * @package     UpworkAPI
 * @since       06/13/2016
 * @copyright   Copyright 2016(c) Upwork.com
 * @author      Maksym Novozhylov <mnovozhilov@upwork.com>
 * @license     Upwork's API Terms of Use {@link https://developers.upwork.com/api-tos.html}
 */

namespace Upwork\API\Routers;

use Upwork\API\Debug as ApiDebug;
use Upwork\API\Client as ApiClient;
use Upwork\API\ApiException as ApiException;

/**
 * Messages
 *
 * @link https://developers.upwork.com/#messages-new
 */
final class Messages extends ApiClient
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
     * Retrieve rooms information
     *
     * @param   array $params List of parameters
     * @access  public
     * @return  object
     */
    public function getRooms($company, $params = array())
    {
        ApiDebug::p(__FUNCTION__);
        throw new ApiException('The legacy API was deprecated. Please, use GraphQL call - see example in this library.');
    }

    /**
     * Get a specific room information
     *
     * @param   string $company Company ID
     * @param   string $roomId Room ID
     * @param   array $params List of parameters
     * @access  public
     * @return  object
     */
    public function getRoomDetails($company, $roomId, $params = array())
    {
        ApiDebug::p(__FUNCTION__);
        throw new ApiException('The legacy API was deprecated. Please, use GraphQL call - see example in this library.');
    }

    /**
     * Get messages from a specific room
     *
     * @param   string $company Company ID
     * @param   string $roomId Room ID
     * @param   array $params List of parameters
     * @access  public
     * @return  object
     */
    public function getRoomMessages($company, $roomId, $params = array())
    {
        ApiDebug::p(__FUNCTION__);
        throw new ApiException('The legacy API was deprecated. Please, use GraphQL call - see example in this library.');
    }

    /**
     * Get a specific room by offer ID
     *
     * @param   string $company Company ID
     * @param	integer $offerId Offer ID
     * @param   array $params List of parameters
     * @access  public
     * @return  object
     */
    public function getRoomByOffer($company, $offerId, $params = array())
    {
        ApiDebug::p(__FUNCTION__);
        throw new ApiException('The legacy API was deprecated. Please, use GraphQL call - see example in this library.');
    }

    /**
     * Get a specific room by application ID
     *
     * @param   string $company Company ID
     * @param	integer $applicationId Application ID
     * @param   array $params List of parameters
     * @access  public
     * @return  object
     */
    public function getRoomByApplication($company, $applicationId, $params = array())
    {
        ApiDebug::p(__FUNCTION__);
        throw new ApiException('The legacy API was deprecated. Please, use GraphQL call - see example in this library.');
    }

    /**
     * Get a specific room by contract ID
     *
     * @param   string $company Company ID
     * @param	integer $contractId Contract ID
     * @param   array $params List of parameters
     * @access  public
     * @return  object
     */
    public function getRoomByContract($company, $contractId, $params = array())
    {
        ApiDebug::p(__FUNCTION__);
        throw new ApiException('The legacy API was deprecated. Please, use GraphQL call - see example in this library.');
    }

    /**
     * Create a new room
     *
     * @param   string $company Company ID
     * @param   array $params List of parameters
     * @access  public
     * @return  object
     */
    public function createRoom($company, $params = array())
    {
        ApiDebug::p(__FUNCTION__);
        throw new ApiException('The legacy API was deprecated. Please, use GraphQL call - see example in this library.');
    }

    /**
     * Send a message to a room
     *
     * @param   string $company Company ID
     * @param	string $roomId Room ID
     * @param   array $params List of parameters
     * @access  public
     * @return  object
     */
    public function sendMessageToRoom($company, $roomId, $params = array())
    {
        ApiDebug::p(__FUNCTION__);
        throw new ApiException('The legacy API was deprecated. Please, use GraphQL call - see example in this library.');
    }

    /**
     * Send a message to a batch of rooms
     *
     * @param   string $company Company ID
     * @param   array $params List of parameters
     * @access  public
     * @return  object
     */
    public function sendMessageToRooms($company, $params = array())
    {
        ApiDebug::p(__FUNCTION__);
        throw new ApiException('The legacy API was deprecated. Please, use GraphQL call - see example in this library.');
    }

    /**
     * Update a room settings
     *
     * @param   string $company Company ID
     * @param	string $roomId Room ID
     * @param	string $username User ID
     * @param   array $params List of parameters
     * @access  public
     * @return  object
     */
    public function updateRoomSettings($company, $roomId, $username, $params = array())
    {
        ApiDebug::p(__FUNCTION__);
        throw new ApiException('The legacy API was deprecated. Please, use GraphQL call - see example in this library.');
    }

    /**
     * Update the metadata of a room
     *
     * @param   string $company Company ID
     * @param	string $roomId Room ID
     * @param   array $params List of parameters
     * @access  public
     * @return  object
     */
    public function updateRoomMetadata($company, $roomId, $params = array())
    {
        ApiDebug::p(__FUNCTION__);
        throw new ApiException('The legacy API was deprecated. Please, use GraphQL call - see example in this library.');
    }
}
