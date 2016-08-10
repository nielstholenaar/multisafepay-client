# MultiSafepay API Client

[![Build Status](https://travis-ci.org/nielstholenaar/multisafepay-client.svg?branch=master)](https://travis-ci.org/nielstholenaar/multisafepay-client)

The code within this repository is a work in progress.

Example:

```
    $client = new Client();
    
    $client->setApiKey('XXXXX-XXXXX-XXXXX');
    
    $request = $client->createListGatewaysRequest();
    
    $response = $client->executeRequest($request);
```


