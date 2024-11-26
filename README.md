PHP bindings for Upwork API (OAuth2)
============

[![License](http://img.shields.io/packagist/l/upwork/php-upwork-oauth2.svg)](http://www.apache.org/licenses/LICENSE-2.0.html)
[![Latest Stable Version](https://poser.pugx.org/upwork/php-upwork-oauth2/v/stable.svg)](https://github.com/upwork/php-upwork-oauth2/releases)
[![Package version](http://img.shields.io/packagist/v/upwork/php-upwork-oauth2.svg)](https://packagist.org/packages/upwork/php-upwork-oauth2)
[![Build status](https://github.com/upwork/php-upwork-oauth2/workflows/build/badge.svg)](https://github.com/upwork/php-upwork-oauth2/actions)
[![Monthly downloads](http://img.shields.io/packagist/dm/upwork/php-upwork-oauth2.svg)](https://packagist.org/packages/upwork/php-upwork-oauth2)

# Introduction
This project provides a set of resources of Upwork API from http://developers.upwork.com
 based on OAuth 2.0.

# Features
The library supports all GraphQL calls, which are publicly shared at Upwork

# License

Copyright 2018 Upwork Corporation. All Rights Reserved.

php-upwork-oauth2 is licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.

## SLA
The usage of this API is ruled by the Terms of Use at:

    https://developers.upwork.com/api-tos.html

# Application Integration
To integrate this library you need to have:

* PHP >= 5.6.0
* Composer installed

## Example
In addition to this, a full example is available in the `example` directory. 
This includes `example.php` that gets an access token and requests the data.

There is also a `composer.json` included to use with Composer.

## Composer
In order to easily integrate with your application we recommend using
[Composer](https://getcomposer.org) to install the dependencies.

Below is a simple example of the `composer.json` file you can use:

    {
        "name": "upwork/my-oauth2-app",
        "require": {
            "upwork/php-upwork-oauth2": "dev-master"
        }
    }

## Installation using Composer
1.
Add `upwork/php-upwork-oauth2` to your `composer.json`, simple example:
```
{
    "name": "my/my-oauth-app",
    "require": {
        "upwork/php-upwork-oauth2": "v2.0.0" // note: the latest release is recommended
    }
}
```

2.
run the following command `/usr/local/bin/composer.phar update`

the output should look similar to
```
Loading composer repositories with package information
Updating dependencies (including require-dev)
  - Installing upwork/php-upwork-oauth2 (v2.0.0)
    Downloading: 100%         

Writing lock file
Generating autoload files
```

3.
IMPORTANT:
The library supports different OAuth2 clients, by default it uses `thephpleague/oauth2-client`. 
In case you don't want to use it, or you don't have the possibility to install it, you can create 
your own wrapper (check `vendor/upwork/php-upwork-oauth2/src/Upwork/API/AuthTypes/` to see how it works).

copy `vendor/upwork/php-upwork-oauth2/example/example.php` to the `myapp.php` if you have

*NOTE: if you use your own wrapper, update 'authType' property in the configuration section of
`myapp.php` and specify the name of your handler.*

4.
open `myapp.php` and type the `clientId`, `clientSecret` and `redirectUri` that you previously got from the API Center.
*Please, read carefully the comments in the example.*

***That's all. Run your app as `php myapp.php` and have fun.***
