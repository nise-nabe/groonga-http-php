<?php

namespace Groonga\Http;

class Client
{
  private $client;

  public function __construct() {
    $this->client = new \Guzzle\Http\Client('http://localhost');
  }

  public function status() {
    $request = $this->client->get('/d/status.json');
    $response = $request->send();

    return json_decode($response->getBody());
  }
}
