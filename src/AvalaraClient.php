<?php

namespace Mjmarianetti\Avalara;

use GuzzleHttp\Client;
use Exception;

class AvalaraClient
{
  protected $apiKey;

  protected $baseUrl = 'https://taxrates.api.avalara.com:443/';

  public function __construct($config)
  {
    $this->apiKey = $config['api_key'];
  }

  public function getTaxesByAddress($params)
  {
    return $this->call('address', $params);
  }

  public function getTaxesByPostal($params)
  {
    return $this->call('postal', $params);
  }

  public function call($url, $params)
  {
    $client = new Client();

    if (!$params['apikey']) {
      $params['apikey'] = $this->apiKey;
    }

    $response = $client->request('GET', $this->baseUrl.$url, [
      'query' => $params,
    ]);

    if (!isset($response)) {
      throw new Exception('No response from API');
    }

    if ($response->getStatusCode() !== 200) {
      throw new Exception($response->getBody());
    }

    return $response->getBody();
  }
}
