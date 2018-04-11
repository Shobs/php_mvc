<?php

  class Database {
    private static $instance = NULL;

    private function __construct() {}

    private function __clone() {}

    public static function getInstance($configs) {

      if (!isset(self::$instance)) {

        $DB = $configs['DB'];

        self::$instance = new PDO($DB['dsn'] , $DB['username'] , $DB['password'], $DB['options']);
      }
      return self::$instance;
    }
  }
?>