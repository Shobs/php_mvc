<?php
class HomeController {


  public function index() {

    $errorMessage = '';
    if (isset($_SESSION['err_mess'])) {
      $errorMessage = $_SESSION['err_mess'];
      unset($_SESSION['err_mess']);
    }

    require_once('views/public/index.php');
  }

    /**
   * Add malware info to database
   */
  public function upload(){
    echo 'landed';
    if (!$_FILES) {
      $this->backToHome('File is missing.');
    }

    $files = array( 'inputFile');

    foreach( $files AS $key ) {
      if ( !empty( $_FILES[ $key ] ) ) {
        ${$key} = $_FILES[ $key ]['tmp_name'];
      } else {
        ${$key} = NULL;
      }
    }

    $signature = Malware::generateSignature($inputFile);

    // if something went wrong with signature generation
    if (!isset($signature) || is_null($signature)) {
      $this->backToHome('Signature could not be generated!');
    }

    $malware = Malware::findBySignature($signature);

    // if there was a problem with saving malware to DB
    if (!$malware) {
      $this->backToHome('File signature not found in database.');
    }

    $name = $malware->name;

    // we made it!
    $this->backToHome("It's very likely that this file is infected with $name malware!");
  }

    /**
   * Redirects to login page with error message
   * @param  [string] $message Error message to be saved to session
   */
  private function backToHome($message = null){
    $_SESSION['err_mess'] = $message;
    header("Location:../home");
    die();
  }
}
?>