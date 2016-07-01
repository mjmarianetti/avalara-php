<?php

namespace Mjmarianetti\Avalara\Tests;

use Mjmarianetti\Avalara\AvalaraClient;

class ClientTest extends \PHPUnit_Framework_TestCase
{
  /*
  Example response:

  "totalRate": 9.600000,
  "rates": [
  {
  "rate": 6.500000,
  "name": "WASHINGTON",
  "type": "State"
},
{
"rate": 3.100000,
"name": "SEATTLE",
"type": "City"
}
]
}
*/

protected $apiKey;

public function setUp()
{
  $dotenv = new \Dotenv\Dotenv(__DIR__);
  $dotenv->load();
  $dotenv->required('AVALARA_API_KEY');
  $this->apiKey = getenv('AVALARA_API_KEY');
}

public function testCanCreateInstance()
{
  $this->assertInstanceOf('Mjmarianetti\Avalara\AvalaraClient', new AvalaraClient($this->apiKey));
}

public function testGetAddress()
{
  $client = new AvalaraClient($this->apiKey);

  $params = [
    'country' => 'usa',
    'street' => '435 Ericksen Ave NE',
    'city' => 'Bainbridge Island',
    'state' => 'WA',
    'postal' => '98110',
  ];

  $response = $client->getTaxesByAddress($params);

  $this->assertNotNull($response->totalRate);
  $this->assertGreaterThan(0,$response->totalRate);

}

public function testGetAddressWithWrongCountry()
{
  $client = new AvalaraClient($this->apiKey);

  $params = [
    'country' => 'arg',
    'street' => '435 Ericksen Ave NE',
    'city' => 'Bainbridge Island',
    'state' => 'WA',
    'postal' => '98110',
  ];

  $response = $client->getTaxesByAddress($params);
  $this->assertNotNull($response->totalRate);
  $this->assertEquals($response->totalRate, 0);
}


public function testGetPostal()
{
  $client = new AvalaraClient($this->apiKey);

  $params = [
    'country' => 'usa',
    'postal' => '98104',
  ];

  $response = $client->getTaxesByPostal($params);
  $this->assertNotNull($response->totalRate);
  $this->assertGreaterThan(0,$response->totalRate);
}

public function testGetPostalWithWrongCountry()
{
  $client = new AvalaraClient($this->apiKey);

  $params = [
    'country' => 'arg',
    'postal' => '98104',
  ];

  $response = $client->getTaxesByPostal($params);
  $this->assertNotNull($response->totalRate);
  $this->assertEquals($response->totalRate, 0);
}

}
