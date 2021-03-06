<?php
/**
 * Login controller
 */
class LoginController {

  /**
   * Displays the login form and parse error message
   * @return [type] [description]
   */
  public function index() {
    $errorMessage = '';
    if (isset($_SESSION['err_mess'])) {
      $errorMessage = $_SESSION['err_mess'];
      unset($_SESSION['err_mess']);
    }
    require_once('views/pages/login.php');
  }

  /**
   * Main authentication function
   */
  public function auth(){

    $expected = array( 'inputEmail', 'inputPassword' );

    foreach( $expected AS $key ) {
      if ( !empty( $_POST[ $key ] ) ) {
        ${$key} = $this->sanitize($_POST[ $key ]);
      } else {
        ${$key} = NULL;
      }

      // Dynamically call the right validate function
      $field = str_replace('input', '', strtolower($key));
      $validate = 'validate_' . $field;

      // Making sure specific validator exists
      if (method_exists('Utils', $validate)) {
        $message = Utils::{$validate}(${$key});
        if (!empty($message)) $this->backToLogin($user, $message);
      } else {
        $this->backToLogin($user, "Something went wrong. Contact administrator.");
      }
    }

    $user = User::findByEmail($inputEmail);

    // verifying user exist and is admin
    //
    if ($user->id == null || !$user->isAdmin()) {
      $this->backToLogin($user, "Invalid email or password.");
    }

    // Verifying the passwords match
    if (!$this->isPassword($user, $inputPassword)) {
      $this->backToLogin($user, "Invalid email or password.");
    }

    $this->login($user);
  }

  /**
   * Compare form password against DB password
   * @param  [type]  $user          User data from DB
   * @param  [type]  $inputPassword User input from form
   * @return boolean
   */
  private function isPassword($user, $inputPassword){
    return (Utils::hashPassword($inputPassword, $user->salt) === $user->password);
  }

  /**
   * Redirects to login page with error message
   * @param  [type] $user    user data from DB
   * @param  [type] $message Error message to be saved to session
   */
  private function backToLogin($user, $message){
    unset($user);
    $_SESSION['err_mess'] = $message;
    header("Location:../login");
    die();
  }

  /**
   * Adds current user to session
   * @param [type] $user User data from DB
   */
  private function setSession($user){
    // fixation prevention
    $_SESSION['check'] = hash('ripemd128', $_SERVER['REMOTE_ADDR'] .$_SERVER['HTTP_USER_AGENT']);
    $_SESSION['initiated'] = true;
    $_SESSION['username'] = $user->email;
    $_SESSION['isAdmin'] = $user->isAdmin();
    $_SESSION['isLogged'] = true;
  }

  /**
   * String sanitization for safe mysql query use
   * @param  [type] $string Unsanitized form input string
   * @return [type]         Sanitized input string
   */
  private function sanitize($string){
    return Utils::mysqlEntitiesFixString($string);
  }

  /**
   * Saves user to session and redirects
   * @param  [type] $user [description]
   * @return [type]       [description]
   */
  private function login($user){

    $this->setSession($user);

    if ($user->isAdmin()) {
      header("Location:../admin");
    } else {
      header("Location:../home");
    }
    die();
  }

  /**
   * Logs out user and destroys sessions
   * @return [type] [description]
   */
  public function logout(){
    Utils::destroySessionAndData();
    header("Location:../home");
    die();
  }
}

?>