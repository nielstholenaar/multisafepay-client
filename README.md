# MultiSafepay API Client

[![Build Status](https://travis-ci.org/nielstholenaar/multisafepay-client.svg?branch=master)](https://travis-ci.org/nielstholenaar/multisafepay-client) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/nielstholenaar/multisafepay-client/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/nielstholenaar/multisafepay-client/?branch=master)

The code within this repository is a work in progress.

Example:

```
    $client = new Client();
    
    $client->setApiKey('XXXXX-XXXXX-XXXXX');
    
    $request = $client->createListGatewaysRequest();
    
    $response = $client->executeRequest($request);
```


