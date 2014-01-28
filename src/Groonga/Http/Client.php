<?php

namespace Groonga\Http;

class Client
{
  private $client;

  /**
   * @param string $url
   */
  public function __construct($url = 'http://localhost:10041') {
    $this->client = new \Guzzle\Http\Client($url);
  }

  /**
   * @return mixed
   *
   * @see http://groonga.org/ja/docs/reference/commands/status.html
   */
  public function status() {
    $request = $this->client->get('/d/status.json');
    $response = $request->send();

    return json_decode($response->getBody());
  }

  /**
   *  [flags=TABLE_HASH_KEY]
   *  [key_type=null]
   *  [value_type=null]
   *  [default_tokenizer=null]
   *  [normalizer=null]
   *
   * @param $name
   * @param $params
   * @return mixed
   *
   * @see http://groonga.org/ja/docs/reference/commands/table_create.html
   */
  public function tableCreate($name, $params) {
    $request = $this->client->get('/d/table_create.json');
    $request->set('name', $name);
    foreach ($params as $k => $v) {
      $request->set($k, $v);
    }
    $response = $request->send();

    return json_decode($response->getBody());
  }

  /**
   *  [match_columns=null]
   *  [query=null]
   *  [filter=null]
   *  [scorer=null]
   *  [sortby=null]
   *  [output_columns="_id, _key, *"]
   *  [offset=0]
   *  [limit=10]
   *  [drilldown=null]
   *  [drilldown_sortby=null]
   *  [drilldown_output_columns=null]
   *  [drilldown_offset=0]
   *  [drilldown_limit=10]
   *  [cache=yes]
   *  [match_escalation_threshold=0]
   *  [query_expansion=null]
   *  [query_flags=ALLOW_PRAGMA|ALLOW_COLUMN|ALLOW_UPDATE|ALLOW_LEADING_NOT|NONE]
   *  [query_expander=null]
   *
   * @param $table
   * @param $params
   * @return mixed
   *
   * @see http://groonga.org/ja/docs/reference/commands/select.html
   */
  public function select($table, $params) {
    $request = $this->client->get('/d/select.json');
    $request->set('table', $table);
    foreach ($params as $k => $v) {
      $request->set($k, $v);
    }
    $response = $request->send();

    return json_decode($response->getBody());
  }

  /**
   * @param $table
   * @param $name
   * @param $flags
   * @param $type
   * @param string|null $source
   *
   * @return mixed
   *
   * @see http://groonga.org/ja/docs/reference/commands/column_create.html
   */
  public function craateColumn($table, $name, $flags, $type, $source = null) {
    $request = $this->client->get('/d/create_column.json');
    $request->set('table', $table);
    $request->set('name', $name);
    $request->set('flags', $flags);
    $request->set('type', $type);
    if ($source !== null) {
      $request->set('type', $source);
    }
    $response = $request->send();

    return json_decode($response->getBody());
  }

  /**
   * @param $table
   * @return mixed
   *
   * @see http://groonga.org/ja/docs/reference/commands/truncate.html
   */
  public function truncate($table) {
    $request = $this->client->get('/d/truncate.json');
    $request->set('table', $table);
    $response = $request->send();

    return json_decode($response->getBody());
  }
}
