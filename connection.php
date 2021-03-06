<?php
/**
 * Singleton database connection class
 */
class Database {
  private static $instance = NULL;

  private function __construct() {}

  private function __clone() {}

  public static function getInstance() {
    global $configs;

    if (!isset(self::$instance)) {

      $DB = $configs['DB'];

      self::$instance = new mysqli($DB['host'], $DB['username'] , $DB['password'], $DB['DBName']);

      if (self::$instance->connect_error) die(mysql_fatal_error(self::$instance->connect_error));
      }
    return self::$instance;
  }

  public function mysql_fatal_error($msg)
  {
    $msg2 = mysql_error();
    echo <<< _END
    We are sorry, but it was not possible to complete
    the requested task. The error message we got was:
    <p>$msg: $msg2</p>
    Please click the back button on your browser
    and try again. If you are still having problems,
    please <a href="mailto:admin@server.com">email
    our administrator</a>. Thank you.
_END;
    }
  }
  ?>