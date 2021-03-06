<?php
class User {
    // we define 3 attributes
    // they are public so that we can access them using $post->author directly
  public $id;
  public $firstname;
  public $lastname;
  public $email;
  public $role;

  public function __construct($id, $firstname, $lastname, $email, $role, $salt, $password) {
    $this->id      = $id;
    $this->firstname  = $firstname;
    $this->lastname = $lastname;
    $this->email  = $email;
    $this->role = $role;
    $this->salt = $salt;
    $this->password = $password;
  }

  public static function findByID($id) {
      // we make sure $id is an integer
    $id = intval($id);
    $conn = Database::getInstance();
    $sql = "SELECT * FROM thr_users WHERE id = $id";
    $result = $conn->query($sql);
      // the query was prepared, now we replace :id with our actual $id value
    $row = $result->fetch_assoc();

    return new User($row['id'], $row['firstname'], $row['lastname'], $row['email'], $row['role'], $row['salt'], $row['password']);
  }

  public static function findByEmail($email) {
      // we make sure $email is a string
    $email = strval($email);
    $conn = Database::getInstance();
    $sql = "SELECT * FROM thr_users WHERE email = '$email'";
    $result = $conn->query($sql) or die($conn->error);

    $row = $result->fetch_assoc();

    return new User($row['id'], $row['firstname'], $row['lastname'], $row['email'], $row['role'], $row['salt'], $row['password']);
  }

  public function isAdmin(){
    return ($this->role === "admin");
  }

}
?>