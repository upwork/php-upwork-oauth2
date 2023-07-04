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

namespace Upwork\API\AuthTypes;

use Upwork\API\Debug as ApiDebug;
use Upwork\API\Config as ApiConfig;
use Upwork\API\Interfaces\Client as ApiClient;
use Upwork\API\Utils as ApiUtils;
use Upwork\API\ApiException as ApiException;
use Upwork\API\AuthTypes\AbstractOAuth as AbstractOAuth;

use Psr\Http\Message\RequestInterface;
use GuzzleHttp\Middleware;

/**
 * OAuth 2.0 Client based on league/oauth2-client Library, as an example
 * see https://github.com/thephpleague/oauth2-client
 */
final class OAuth2ClientLib extends AbstractOAuth implements ApiClient
{
    /**
     * OAuth2 instance
     */
    private static $_provider = null;

    /**
     * Get instance
     *
     * @return  object
     * @access  public
     */
    public function getInstance()
    {
        return (self::$_provider instanceof \League\OAuth2\Client\Provider\GenericProvider)
                ? self::$_provider
            : $this->_getOAuthInstance();
    }

    /**
     * Request authorization
     * 
     * @param   string $type Type of request
     * @param   string $url URL
     * @param   array $params (Optional) Parameters
     * @param   string $tenantId (Optional) Organization UID
     * @access  public
     * @return  mixed
     * @throw	ApiException Invalid method requested
     */
    public function request($type, $url, $params = array(), string $tenantId = null)
    {
        ApiDebug::p('running request from ' . __CLASS__);

        switch ($type) {
            case \League\OAuth2\Client\Provider\AbstractProvider::METHOD_POST:
                    if (self::$_epoint == UPWORK_GRAPHQL_EP_NAME) {
                    $options = array('headers' => array('content-type' => 'application/json'));
                        is_null($tenantId) || $options['headers']['X-Upwork-API-TenantId'] = $tenantId;
                $options['body'] = $params;
                    } else {
                    $options = array('headers' => array('content-type' => 'application/x-www-form-urlencoded'));
                $options['body'] = http_build_query($params, null, '&', \PHP_QUERY_RFC3986);
                    }

            $url = ApiUtils::getFullUrl($url, self::$_epoint);
            break;
            case \League\OAuth2\Client\Provider\AbstractProvider::METHOD_GET:
            $options = array();
                $url = ApiUtils::getFullUrl($url, self::$_epoint, (($type == 'GET' ? $params : null)));
            break;
            default:
            throw new ApiException('Unsupported HTTP method.');
        }

        $options['headers']['user-agent'] = ApiConfig::UPWORK_LIBRARY_USER_AGENT;
        $request = $this->getInstance()->getAuthenticatedRequest($type, $url, self::$_accessToken, $options);

        ApiDebug::p('prepared request', $request);

        try {
            // do not use getParsedResponse, it returns an array
            // but we need a raw json that will be decoded and returned as StdClass object
            $response = $this->getInstance()->getResponse($request);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $eResponse = $e->getResponse();
            $response = $eResponse->getBody()->getContents();
        } catch (\Exception $e) {
            $response = $e->getResponseBody();
        }

        ApiDebug::p('got response from server', $response);

        return (string) $response->getBody();
    }

    /**
     * Get access token
     *
     * @param	string $authzCode	Authorization code (a received verifier)
     * @param	string $grantType   Grant Type
     * @access	protected
     * @return	array
     */
    protected function _setupTokens($authzCode, $grantType)
    {
        ApiDebug::p('requesting access token');

	    return $this->_requestTokens($grantType, array('code' => $authzCode));
    }

    /**
     * Refresh the existing access token
     *
     * @param	string $refreshToken	Existing refresh token
     * @access	protected
     * @return	array
     */
    protected function _refreshTokens($refreshToken)
    {
        ApiDebug::p('refreshing the existing access token');

        return $this->_requestTokens('refresh_token', array('refresh_token' => $refreshToken));
    }

    /**
     * Get OAuth2 instance
     *
     * @param   integer $authType Auth type
     * @access  protected
     * @return  object
     */
    protected function _getOAuthInstance($authType = null)
    {
        ApiDebug::p('get OAuth2 instance');

        $options = array(
            'clientId' => self::$_clientId, 
            'clientSecret' => self::$_clientSecret,
            'redirectUri' => self::$_redirectUri,
            'urlAuthorize' => ApiUtils::getFullUrl(self::URL_AUTH, ''),
            'urlAccessToken' => ApiUtils::getFullUrl(self::URL_ATOKEN, 'api'),
            'urlResourceOwnerDetails' => ''
        );
        
	    self::$_provider = new \League\OAuth2\Client\Provider\GenericProvider($options);

        return self::$_provider;
    }

    /**
     * Request tokens
     *
     * @param	string $type	Type of request (authorization_code|refresh_token)
     * @param	array $options	Parameters for AccessToken object
     * @access	private
     * @return	array
     */
    private function _requestTokens(string $type, array $options)
    {
        ApiDebug::p('requesting tokens');

        $accessTokenInfo = array();

	    $accessToken = $this->getInstance()->getHttpClient()->getConfig()['handler']->push(
            Middleware::mapRequest(function (RequestInterface $request) {
                return $request->withHeader('User-Agent', ApiConfig::UPWORK_LIBRARY_USER_AGENT);
            }));
        $accessToken = $this->getInstance()->getAccessToken($type, $options);

        $accessTokenInfo['access_token']  = $accessToken->getToken();
        $accessTokenInfo['expires_in']    = $accessToken->getExpires();

        self::$_accessToken  = $accessTokenInfo['access_token'];
        self::$_expiresIn    = $accessTokenInfo['expires_in'];

        if ($type === 'authorization_code') {
            $accessTokenInfo['refresh_token'] = $accessToken->getRefreshToken();
            self::$_refreshToken = $accessTokenInfo['refresh_token'];
        }

        ApiDebug::p('got access token info', $accessTokenInfo);

        return $accessTokenInfo;
    }

    /**
     * Get curl options
     *
     * @static
     * @return  array
     * @access  private
     */
    private static function _getCurlOptions()
    {
        $options = array();
        $options[CURLOPT_SSL_VERIFYPEER] = self::$_verifySsl;

        return $options;
    }
}
