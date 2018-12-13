<?php
/**
 * Upwork auth library for using with public API by OAuth
 *
 * @final
 * @package     UpworkAPI
 * @since       01/02/2018
 * @copyright   Copyright 2018(c) Upwork.com
 * @author      Maksym Novozhylov <mnovozhilov@upwork.com>
 * @license     Upwork's API Terms of Use {@link https://developers.upwork.com/api-tos.html}
 */

namespace Upwork\API;

use Upwork\API\ApiException as ApiException;

/**
 * Config factory
 */
final class Config
{
    /**
     * @var Consumer key
     */
    static private $_clientId;
    /**
     * @var Consumer secret
     */
    static private $_clientSecret;
    /**
     * @var Received access token
     */
    static private $_accessToken;
    /**
     * @var Redirect URI
     */
    static private $_redirectUri;
    /**
     * @var Received refresh
     */
    static private $_refreshToken;
    /**
     * @var Received expires_in
     */
    static private $_expiresIn;
    /**
     * @var Authorization code from authorization screen
     */
    static private $_code;
    /**
     * @var Application mode, i.e. web or nonweb
     */
    static private $_mode = 'nonweb';
    /**
     * @var Type of auth
     */
    static private $_authType = 'OAuth2ClientLib';
    /**
     * @var SSL verification
     */
    static private $_verifySsl = true;
    /**
     * @var Debug mode
     */
    static private $_debug = false;

    /**
     * User-Agent
     */
    const UPWORK_LIBRARY_USER_AGENT = 'Github Upwork API PHP Client';

    /**
     * Constructor
     *
     * @param   array $data Array of parameters
     * @throws  ApiException Unknown property
     */
    public function __construct(array $data)
    {
        foreach ($data as $k => $v) {
            $res = self::set($k, $v);
            if (!$res) {
                throw new ApiException('Property [' . $k . '] is unknown or can not be set.');
            }
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
    public static function set($option, $value)
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
     * Get option
     *
     * @param   string $option Option name
     * @static
     * @access  public
     * @return  mixed
     * @throws  ApiException Wrong property
     */
    public static function get($option)
    {
        $name = '_' . $option;

        if (!property_exists('Upwork\API\Config', $name)) {
            throw new ApiException('Wrong property name requested.');
        }

        return self::$$name;
    }
}
