# avalara-php
Wrapper for Avalara Tax API

# Installation

    composer require mjmarianetti/avalara-php

## Laravel 5.x

Add the next line to your service providers

    Mjmarianetti\Avalara\AvalaraServiceProvider::class,

Publish avalara.php config file

    php artisan vendor:publish --provider="Mjmarianetti\Avalara\AvalaraServiceProvider"

# Usage

    use Mjmarianetti\Avalara\AvalaraClient;
    
    $client = new AvalaraClient('API_KEY');
    
    $params = [
      'country' => 'usa',
      'street' => '435 Ericksen Ave NE',
      'city' => 'Bainbridge Island',
      'state' => 'WA',
      'postal' => '98110'
    ];

    $response = $client->getTaxesByAddress($params);
    var_dump($response);

## Dependency Injection
If using Laravel, you can inject it as a dependency

    public funcion index(AvalaraClient $client){
      $params = [
      'country' => 'usa',
      'street' => '435 Ericksen Ave NE',
      'city' => 'Bainbridge Island',
      'state' => 'WA',
      'postal' => '98110'
      ];
      $client->getTaxesByAddress($params);
    }

##Methods:

### Taxes by Address

    $params = [
      'country' => 'usa',
      'street' => '435 Ericksen Ave NE',
      'city' => 'Bainbridge Island',
      'state' => 'WA',
      'postal' => '98110'
    ];
    
    $client->getTaxesByAddress($params);
   
### Taxes by Zip Code

    $params = [
      'country' => 'usa',
      'postal' => '98104'
    ];
    
    $client->getTaxesByPostal($params);
   
   
   
    
