<?php

use Illuminate\Database\Capsule\Manager as Capsule;

require "vendor/autoload.php";


class MySQLHandler implements DbHandler {

  private $capsule;
  private $_table;

  public function __construct($table) {
    $this->_table = $table;
    $this->connect();
  }

public function connect(){
  $this->capsule = new Capsule;

  $this->capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => __HOST__,
    'database'  => __DB__,
    'username'  => __USER__,
    'password'  => __PASS__,
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
  ]);
    if ($this->capsule) {
      $this->capsule->setAsGlobal();
      $this->capsule->bootEloquent();
      return true;
    } else {
      return false;
    }
  }

  public function disconnect(){
    if ($this->capsule){
      $this->capsule->getDatabaseManager()->disconnect();
      return true;
  }
  return false;
  }

  public function get_record_by_id($id,$primary_key){
    $record = $this->capsule->table($this->_table)->where($primary_key, $id)->get();
    if ($record->isNotEmpty()) {
      return $record->first();
    } else {
      return null;
    }
  }

  public function get_data($fields = array(), $start = 0, $limit = 5, $search = null) {
    $query = $this->capsule->table($this->_table);

    if (!empty($fields)) {
      $query->select($fields);
    }

    if ($search) {
      $query->where('product_name', 'like', '%' . $search . '%');
    }

    $query->offset($start)->limit($limit);
    return $query->get();
  }

  public function get_total_records($search = null) {
    $query = $this->capsule->table($this->_table);
    if ($search) {
      $query->where('product_name', 'like', '%' . $search . '%');
    }
    return $query->count();
  }


}

?>