<?php

namespace Groonga\Http;

use Groonga\Http\Message\GroongaRequestFactory;

class Client
{
  private $client;

  /**
   * @param string $url
   */
  public function __construct($url = 'http://localhost:10041') {
    $this->client = new \Guzzle\Http\Client($url);
    $this->client->setRequestFactory(new GroongaRequestFactory());
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
    $query = $request->getQuery();
    $query->set('name', $name);
    foreach ($params as $k => $v) {
      $query->set($k, $v);
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
  public function select($table, $params = array()) {
    $request = $this->client->get('/d/select.json');
    $query = $request->getQuery();
    $query->set('table', $table);
    foreach ($params as $k => $v) {
      $query->set($k, $v);
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
  public function columnCreate($table, $name, $flags, $type, $source = null) {
    $request = $this->client->get('/d/column_create.json');
    $query = $request->getQuery();
    $query->set('table', $table);
    $query->set('name', $name);
    $query->set('flags', $flags);
    $query->set('type', $type);
    if ($source !== null) {
      $query->set('source', $source);
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
    $query = $request->getQuery();
    $query->set('table', $table);
    $response = $request->send();

    return json_decode($response->getBody());
  }

  /**
   * @param $table
   * @return mixed
   *
   * @see http://groonga.org/ja/docs/reference/commands/table_remove.html
   */
  public function tableRemove($table) {
    $request = $this->client->get('/d/table_remove.json');
    $query = $request->getQuery();
    $query->set('name', $table);
    $response = $request->send();

    return json_decode($response->getBody());
  }

  /**
   * [columns [ifexists [input_type]]]
   *
   * @param $table
   * @param $values
   * @param array $params
   * @return mixed
   *
   * @see http://groonga.org/ja/docs/reference/commands/load.html
   */
  public function load($table, $values, $params = array()) {
    $request = $this->client->get('/d/load.json');
    $query = $request->getQuery();
    $query->set('table', $table);
    $query->set('values', $values);
    foreach ($params as $k => $v) {
      $query->set($k, $v);
    }

    $response = $request->send();

    return json_decode($response->getBody());
  }

  /**
   * @return mixed
   *
   * @see http://groonga.org/ja/docs/reference/commands/table_list.html
   */
  public function tableList() {
    $request = $this->client->get('/d/table_list.json');
    $response = $request->send();

    return json_decode($response->getBody());
  }

  /**
   *  [normalizer=null]
   *  [flags=NONE]
   *
   * @param string $tokenizer
   * @param string $string
   * @param array $params
   * @return mixed
   *
   * @see http://groonga.org/ja/docs/reference/commands/tokenizer.html
   */
  public function tokenize($tokenizer, $string, $params = array()) {
    $request = $this->client->get('/d/tokenize.json');
    $query = $request->getQuery();
    $query->set('tokenizer', $tokenizer);
    $query->set('string', $string);
    foreach ($params as $k => $v) {
      $query->set($k, $v);
    }

    $response = $request->send();

    return json_decode($response->getBody());
  }

  /**
   * @param $normalizer
   * @param $string
   * @param array $params
   *
   * @return mixed
   *
   * @see http://groonga.org/ja/docs/reference/commands/normalize.html
   */
  public function normalize($normalizer, $string, $params = array()) {
    $request = $this->client->get('/d/normalize.json');
    $query = $request->getQuery();
    $query->set('normalizer', $normalizer);
    $query->set('string', $string);
    foreach ($params as $k => $v) {
      $query->set($k, $v);
    }

    $response = $request->send();

    return json_decode($response->getBody());
  }

  /**
   * @param $table
   * @return mixed
   *
   * @see http://groonga.org/ja/docs/reference/commands/column_list.html
   */
  public function columnList($table) {
    $request = $this->client->get('/d/column_list.json');
    $query = $request->getQuery();
    $query->set('table', $table);

    $response = $request->send();

    return json_decode($response->getBody());
  }

  /**
   * @param $table
   * @param $name
   * @return mixed
   *
   * @see http://groonga.org/ja/docs/reference/commands/column_remove.html
   */
  public function columnRemove($table, $name) {
    $request = $this->client->get('/d/column_remove.json');
    $query = $request->getQuery();
    $query->set('table', $table);
    $query->set('name', $name);

    $response = $request->send();

    return json_decode($response->getBody());
  }

  /**
   * ドキュメントと引き数が少し違うがソースを読む限り２つ引き数を取る。
   *
   * @param $table
   * @param $name
   * @param $newName
   * @return mixed
   *
   * @see http://groonga.org/ja/docs/reference/commands/column_rename.html
   */
  public function columnRename($table, $name, $newName) {
    $request = $this->client->get('/d/column_rename.json');
    $query = $request->getQuery();
    $query->set('table', $table);
    $query->set('name', $name);
    $query->set('new_name', $newName);

    $response = $request->send();

    return json_decode($response->getBody());
  }

  /**
   * [key [id [filter]]]
   *
   * @param $table
   * @param array $params
   * @return mixed
   *
   * @see http://groonga.org/ja/docs/reference/commands/delete.html
   */
  public function delete($table, $params = array()) {
    $request = $this->client->get('/d/delete.json');
    $query = $request->getQuery();
    $query->set('table', $table);
    foreach ($params as $k => $v) {
      $query->set($k, $v);
    }

    $response = $request->send();

    return json_decode($response->getBody());
  }
}
