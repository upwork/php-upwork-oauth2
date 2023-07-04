<?php
/**
 * Abstract Upwork auth library for using with public API by OAuth
 *
 * @final
 * @package     UpworkAPI
 * @since       02/02/2018
 * @copyright   Copyright 2018(c) Upwork.com
 * @author      Maksym Novozhylov <mnovozhilov@upwork.com> 
 * @license     Upwork's API Terms of Use {@link https://developers.upwork.com/api-tos.html}
 */

namespace Upwork\API\AuthTypes;

use Upwork\API\Debug as ApiDebug;
use Upwork\API\Config as ApiConfig;
use Upwork\API\Interfaces\Client as ApiClient;
use Upwork\API\Utils as ApiUtils;
use Upwork\API\ApiException as ApiException;

/**
 * Abstract OAuth Client
 */
abstract class AbstractOAuth
{

    const URL_AUTH      = '/ab/account-security/oauth2/authorize';
    const URL_ATOKEN    = '/v3/oauth2/token';
    const URL_RTOKEN    = '/v3/oauth2/token';

    /**
     * @var Client ID (a.k.a. Consumer Key)
     */
    static protected $_clientId = null;
    /**
     * @var Client Secret (a.k.a. Key Secret)
     */
    static protected $_clientSecret = null;
    /**
     * @var Grant Type
     */
    static protected $_grantType = null;
    /**
     * @var Redirect URI
     */
    static protected $_redirectUri = null;
    /**
     * @var refresh token
     */
    static protected $_refreshToken = null;
    /**
     * @var access token
     */
    static protected $_accessToken = null;
    /**
     * @var expires_in
     */
    static protected $_expiresIn = null;
    /**
     * @var Authorization Code
     */
    static protected $_authzCode = null;
    /**
     * @var state
     */
    static protected $_state = null;
    /**
     * @var Entry point name
     */
    static protected $_epoint = 'api';
    /**
     * @var Application mode
     */
    static protected $_mode = 'web';
    /**
     * @var SSL verification flag
     */
    static protected $_verifySsl = true;

    /**
     * Constructor 
     * 
     * @param   string $clientId Application key (clientId)
     * @param	string $clientSecret Secret key (clientSecret)
     * @param	string $redirectUri Redirect URI
     * @access  public
     * @throws  ApiException Wrong clientId or clientSecret
     */
    public function __construct($clientId, $clientSecret, $redirectUri = null)
    {
        ApiDebug::p('starting ' . __CLASS__ . ' authentication');

        if (!$clientSecret) {
            throw new ApiException('You must define "Client Secret (a.k.a. Key Secret)".');
        } else {
            self::$_clientSecret = (string) $clientSecret;
        }

        if (!$clientId) {
            throw new ApiException('You must define "Client ID (a.k.a. Application Key)".');
        } else {
            self::$_clientId = (string) $clientId;
        }

	if ($redirectUri) {
	    self::$_redirectUri = $redirectUri;
	}
    }

    /**
     * Set option
     *
     * @param   string $option Option name
     * @param   mixed $value Option value
     * @access  public
     * @return  boolean
     */
    public static function option($option, $value)
    {
        $name = '_' . $option;

        $r = new \ReflectionClass('\\' . __CLASS__);
        try {
            $r->getProperty($name);
            self::$$name = $value;
            return true;
        } catch (\ReflectionException $e) {
            return false;
        }
    }

    /**
     * Auth process 
     * 
     * @access  public
     * @return  string
     * @throws  ApiException Wrong refresh token
     */
    public function auth()
    {
        ApiDebug::p('running auth process in ' . __CLASS__);

	    if (self::$_accessToken === null && self::$_refreshToken === null && self::$_authzCode === null) {
            if (self::$_grantType == 'authorization_code') { // Code authorization grant type
                $authUrl = $this->getInstance()->getAuthorizationUrl();
                ApiDebug::p('Got authorization URL from OAuth2 instance', $authUrl);

                // save the state - useful for web-based apps to prevent CSRF attacks
                self::$_state = $this->getInstance()->getState();
                ApiDebug::p('Saving state', self::$_state);

                if (self::$_mode === 'web') {
                    // authorize web application via browser
                    header('Location: ' . $authUrl);
                } elseif (self::$_mode === 'nonweb') {
                    // authorize nonweb application
                    ApiDebug::p('found [nonweb] mode, need to authorize application manually');

                    $prompt = 'Visit ' . $authUrl . "\n " .
                        'and provide received code (verifier) for further authorization' . "\n" .
                        '$ ';
                    if (PHP_OS == 'WINNT') {
                        echo $prompt;
                        $authzCode = stream_get_line(STDIN, 1024, PHP_EOL);
                    } else {
                        $authzCode = readline($prompt);
                    }

                    // get access token
                    $this->_setupTokens($authzCode, self::$_grantType);
                }
            } else if (self::$_grantType == 'client_credentials') {
                if (self::$_mode === 'web') {
                    // authorize web application via browser
                    header('Location: ' . $authUrl);
                } elseif (self::$_mode === 'nonweb') {
                    ApiDebug::p('found [nonweb] mode for client credentials grant');
                    // Client credentials grant type
                    $this->_setupTokens(null, self::$_grantType);
                }
            }
	    } elseif (self::$_accessToken === null && self::$_authzCode !== null) {
            // get access token, web-based callback
	        $this->_setupTokens(self::$_authzCode, 'authorization_code');
        } else {
            // access_token isset
            // check if expired and refresh if needed
            if (self::$_expiresIn <= time()) {
                if (self::$_grantType === 'authorization_code') {
                    if (self::$_refreshToken === null) {
                        throw new ApiException('Access token has expired but refresh token is not specified. Can not refresh.');
                    }
                    $this->_refreshTokens(self::$_refreshToken);
                } else if (self::$_grantType === 'client_credentials') {
                    $this->_setupTokens(null, self::$_grantType);
                }
            }
        }

	    ApiDebug::p('Tokens info', array(self::$_accessToken, self::$_refreshToken, self::$_expiresIn));

        return (self::$_grantType === 'authorization_code')
            ? array(
                'access_token'  => self::$_accessToken,
                'refresh_token' => self::$_refreshToken,
                'expires_in'    => self::$_expiresIn
            )
            : array(
                'access_token' => self::$_accessToken,
                'expires_in' => self::$_expiresIn
            );
    }

    /**
     * Get access token
     *
     * @param	string $authzCode Authorization Code, got after authorization
     * @param	string $grantType Grant Type
     * @access	private
     * @return	array
     */
    abstract protected function _setupTokens($authzCode, $grantType);

    /**
     * Get OAuth instance
     *
     * @param   integer $authType Auth type
     * @access  public
     * @return  object
     */
    abstract protected function _getOAuthInstance($authType);
}
