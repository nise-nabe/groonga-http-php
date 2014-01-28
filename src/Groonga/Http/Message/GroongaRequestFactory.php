<?php

namespace Groonga\Http\Message;

class GroongaRequestFactory extends \Guzzle\Http\Message\RequestFactory {
  protected $requestClass = 'Groonga\\Http\\Message\\GroongaRequest';
}
