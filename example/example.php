<?php
/**
 * Authentication library for Upwork API using OAuth 2.0
 * Example: authenticate and send a test request to the protected resource
 *
 * @final
 * @package     UpworkAPI
 * @since       03/02/2018
 * @copyright   Copyright 2018(c) Upwork.com
 * @author      Maksym Novozhylov <mnovozhilov@upwork.com>
 * @license     Upwork's API Terms of Use {@link https://developers.upwork.com/api-tos.html}
 */

require __DIR__ . '/vendor/autoload.php';

// if you already have the tokens, they can be read from session
// or other secure storage
//$_SESSION['access_token'] = 'xxxxxxxxxxxxxxxxxxxxxxxxxxx';
//$_SESSION['access_secret']= 'xxxxxxxxxxxx';

$config = new \Upwork\API\Config(
    array(
        'clientId'          => 'xxxxxxxxxxxxxxxxxxxxxxxxxxx', // SETUP YOUR CONSUMER KEY
        'clientSecret'      => 'xxxxxxxxxxxx', // SETUP KEY SECRET
	'redirectUri'       => 'https://a.callback.url/',
        'accessToken'       => 'xxxxxxxxxxxxxxxxxxxxxxxxxxx', // WARNING: keep this up-to-date!
        'refreshToken'      => 'xxxxxxxxxxxxxxxxxxxxxxxxxxx', // WARNING: keep this up-to-date!
        'expiresIn'         => 'xxxxxxxxxx', // WARNING: keep this up-to-date!
        //'debug'             => true, // enables debug mode
        //'authType'          => 'MyOAuthPHPLib' // your own authentication type, see AuthTypes directory
    )
);

$client = new \Upwork\API\Client($config);

// $accessTokenInfo has the following structure
// array('access_token' => ..., 'refresh_token' => ..., 'expires_in' => ...);
// keeps the access token in a secure place
// gets info of authenticated user
$accessTokenInfo = $client->auth();

// WARNING: auth() will refresh the token for you but you need to check if the token was refreshed
// and replace the old token with a new one in your security data storage.

// if needed, it is possible to access library instance
// using $client->getServer()->getInstance()->...;
// e.g. "if ($client->getServer()->getInstance()->getToken() == 'current-token') { ... }"

// for instance, for web-based applications you may need to get
// and safe 'state' in the session to be able to compare it later
// and prevent a CSRF attack
// "if ($client->getServer()->getInstance()->getState() != 'my-saved-state') { ... }"

$auth = new \Upwork\API\Routers\Auth($client);
$info = $auth->getUserInfo();
print_r($info);
