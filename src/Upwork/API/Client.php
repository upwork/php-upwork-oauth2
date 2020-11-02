<?php
/**
 * Upwork auth library for using with public API by OAuth
 *
 * @final
 * @package     UpworkAPI
 * @since       02/03/2018
 * @copyright   Copyright 2018(c) Upwork.com
 * @author      Maksym Novozhylov <mnovozhilov@upwork.com>
 * @license     Upwork's API Terms of Use {@link https://developers.upwork.com/api-tos.html}
 */

namespace Upwork\API;

use Upwork\API\Config as ApiConfig;
use Upwork\API\Debug as ApiDebug;
use Upwork\API\Utils as ApiUtils;

/**
 * Client
 */
class Client
{
    // we will deal only with json inside library
    // and return already decoded data
    const DATA_FORMAT = 'json';

    /**
     * @var Entry point name
     */
    static protected $_epoint = UPWORK_API_EP_NAME;

    /**
     * @var Server instance (AuthTypes)
     */
    protected $_server;

    /**
     * Constructor
     *
     * @param   ApiConfig $config Config object
     * @access  public
     */
    public function __construct(ApiConfig $config)
    {
        ApiDebug::p('preparing Client');

        $clientId     = $config::get('clientId');
	$clientSecret = $config::get('clientSecret');
	$redirectUri  = $config::get('redirectUri');
        $aToken       = $config::get('accessToken');
        $rToken       = $config::get('refreshToken');
        $expiresIn    = $config::get('expiresIn');
        $verifySsl    = $config::get('verifySsl');
        $auth         = 'Upwork\API\AuthTypes\\' . $config::get('authType');

        $this->_server = new $auth($clientId, $clientSecret, $redirectUri);
        !$aToken    || $this->_server->option('accessToken', $aToken);
        !$rToken    || $this->_server->option('refreshToken', $rToken);
        !$expiresIn || $this->_server->option('expiresIn', $expiresIn);
        $this->_server->option('verifySsl', $verifySsl);
    }

    /**
     * Get server instance
     *
     * @return  object
     * @access  public
     */
    public function getServer()
    {
        return $this->_server;
    }

    /**
     * Get request token for web-base apps
     *
     * @access  public
     * @return  array
     */
    public function getToken()
    {
        ApiDebug::p('getToken');

        return $this->_server->setupTokens();
    }

    /**
     * Auth application
     *
     * @access  public
     * @return  mixed
     */
    public function auth()
    {
        ApiDebug::p('authing Client');

        $this->_server->option('mode', ApiConfig::get('mode'));

        // setup request tokens for web-based app
        // they must be already obrained on the first step
        if (ApiConfig::get('mode') === 'web') {
            $aToken   = ApiConfig::get('accessToken');
            $rToken   = ApiConfig::get('refreshToken');
            $authCode = ApiConfig::get('authzCode');

            !$aToken   || $this->_server->option('accessToken', $aToken);
            !$rToken   || $this->_server->option('refreshToken', $rToken);
            !$authCode || $this->_server->option('authzCode', $authCode);
        }

        return $this->_server->auth();
    }

    /**
     * Run API request
     *
     * @param   string $type Type of request, i.e. method
     * @param   string $url URL
     * @param   array $params (Optional) Additional list of parameters
     * @access  protected
     * @return  array
     */
    protected function _request($type, $url, $params = array())
    {
        ApiDebug::p('running Client request', $this->_server);

        $method = 'POST';
        switch ($type) {
            case 'PUT':
                $params['http_method'] = 'put';
                break;
            case 'DELETE':
                $params['http_method'] = 'delete';
                break;
            case 'GET':
                $method = 'GET';
                break;
            default:
                break;
        }

        if (self::$_epoint == UPWORK_API_EP_NAME) {
            $url = $url . '.' . self::DATA_FORMAT;
        } elseif (self::$_epoint == UPWORK_GDS_EP_NAME) {
            $params['tqx'] = 'out:' . self::DATA_FORMAT;
        }

        $this->_server->option('epoint', self::$_epoint);

        $response = $this->_server->request($method, $url, $params);

	return json_decode($response);
    }

    /**
     * Do GET request 
     * 
     * @param   string $url API URL
     * @param   array $params (Optional) Additional parameters
     * @access  public
     * @return  mixed
     */
    public function get($url, $params = array())
    {
        ApiDebug::p('starting GET request');
        return $this->_request('GET', $url, $params);
    }

    /**
     * Do POST request 
     * 
     * @param   string $url API URL
     * @param   array $params (Optional) Additional parameters
     * @access  public
     * @return  mixed
     */
    public function post($url, $params = array())
    {
        ApiDebug::p('starting POST request');
        return $this->_request('POST', $url, $params);
    }

    /**
     * Do PUT request 
     * 
     * @param   string $url API URL
     * @param   array $params (Optional) Additional parameters
     * @access  public
     * @return  mixed
     */
    public function put($url, $params = array())
    {
        ApiDebug::p('starting PUT request');
        return $this->_request('PUT', $url, $params);
    }

    /**
     * Do DELETE request 
     * 
     * @param   string $url API URL
     * @param   array $params (Optional) Additional parameters
     * @access  public
     * @return  mixed
     */
    public function delete($url, $params = array())
    {
        ApiDebug::p('starting DELETE request');
        return $this->_request('DELETE', $url, $params);
    }
}
