# MultiSafepay API Client

[![Build Status](https://travis-ci.org/nielstholenaar/multisafepay-client.svg?branch=master)](https://travis-ci.org/nielstholenaar/multisafepay-client) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/nielstholenaar/multisafepay-client/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/nielstholenaar/multisafepay-client/?branch=master)

API Client for the MultiSafepay API.

For more information about the MultiSafepay API see: https://www.multisafepay.com/documentation/doc/API-Reference/

## Requirements

The following versions of PHP are supported.

* PHP 5.6
* PHP 7.0
* HTTPlug compatible HTTP Library. (See: http://docs.php-http.org/en/latest/httplug/users.html)

## Installation

You can use `composer require` to add the client to your `composer.json` file.

```
$ composer require ntholenaar/multisafepay-client
```

## Usage

### Client setup.

```php
    $client = new Client();

    $client->setApiKey('API-KEY');
```

### Get all gateways

```php
    $response = $client->environment('test')->api('gateways')->all();
    
    var_dump($response);
```

### Get issuers for an particular gateway.

```php
    $response = $client->environment('test')->api('issuers')->all('IDEAL');
        
    var_dump($response);
```

### Get details about an particular order.

```php
    $response = $client->environment('test')->api('orders')->show('ORDER-ID');
        
    var_dump($response);
```

## Credits

- [Niels Tholenaar](https://github.com/nielstholenaar)


## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
