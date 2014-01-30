<?php

namespace Groonga\Http;

class ExClient extends \Groonga\Http\Client
{
  /**
   * modified return value
   *   array(
   *     'count' => int,
   *     'columns' => array
   *     'data' => array
   *   )
   *
   * @param $table
   * @param array $params
   * @return array|mixed
   *
   * @see \Groonga\Http\Client#select()
   */
  public function select($table, $params = array()) {
    $data = parent::select($table, $params);

    $count = array_shift($data[1][0]);
    $columns = array_shift($data[1][0]);
    $result = array(
      'count' => $count[0],
      'columns' => $columns,
      'data' => array(),
    );
    foreach ($data[1][0] as $d) {
      $r = array();
      foreach ($columns as $i => $column) {
        $r[$column[0]] = $d[$i];
      }
      $result['data'][] = $r;
    }

    return $result;
  }
}
