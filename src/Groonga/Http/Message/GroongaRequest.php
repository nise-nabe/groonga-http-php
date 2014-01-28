<?php

namespace Groonga\Http\Message;

use Groonga\Http\Exception\GroongaException;

use Guzzle\Http\Message\Request;
use Guzzle\Http\Exception\BadResponseException;

class GroongaRequest extends Request {

  public function send() {
    try {
      return parent::send();
    } catch (BadResponseException $e) {
      $response = $e->getResponse();
      $data = json_decode($response->getBody());

      throw new GroongaException($data[0][3]);
    }
  }
}

