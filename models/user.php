<?php
  class User {
    // we define 3 attributes
    // they are public so that we can access them using $post->author directly
    public $id;
    public $firstname;
    public $lastname;
    public $email;
    public $role;

    public function __construct($id, $firstname, $lastname, $email, $role) {
      $this->id      = $id;
      $this->firstname  = $firstname;
      $this->lastname = $lastname;
      $this->email  = $email;
      $this->role = $role;
    }

    // public static function all() {
    //   $list = [];
    //   $db = Db::getInstance();
    //   $req = $db->query('SELECT * FROM posts');

    //   // we create a list of Post objects from the database results
    //   foreach($req->fetchAll() as $post) {
    //     $list[] = new Post($post['id'], $post['author'], $post['content']);
    //   }

    //   return $list;
    // }

    public static function findByID($id) {
      // we make sure $id is an integer
      $id = intval($id);
      $conn = Database::getInstance();
      $sql = "SELECT * FROM thr_users WHERE id = $id";
      $result = $conn->query($sql);
      // the query was prepared, now we replace :id with our actual $id value
      $row = $result->fetch_assoc();

      return new User($row['id'], $row['firstname'], $row['lastname'], $row['email'], $row['role']);
    }

    public static function findByEmail($email) {
      // we make sure $email is a string
      $email = strval($email);
      $conn = Database::getInstance();
      $sql = "SELECT * FROM thr_users WHERE email = '$email'";
      $result = $conn->query($sql) or die($conn->error);

      $row = $result->fetch_assoc()

      return new User($row['id'], $row['firstname'], $row['lastname'], $row['email'], $row['role']);
    }

    public function isAdmin(){
      return ($this->role === "admin");
    }
  }
?>