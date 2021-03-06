<?php
class HomeController {

  /**
   * Display home page
   * @return [type] [description]
   */
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

      $files = array( 'inputFile');
      $message = '';

      foreach( $files as $key ) {
        if ( !empty( $_FILES[ $key ] ) ) {
          ${$key} = $_FILES[ $key ]['tmp_name'];
        } else {
          ${$key} = NULL;
        }

        $message .= Utils::validate($key, ${$key});
      }

      if (!empty($message)) {
        $this->backToHome($message);
      }

      $signature = Malware::generateSignature($inputFile);

      // if something went wrong with signature generation
      if (!isset($signature) || is_null($signature)) {
        $this->backToHome("<span style='color:orange'>Signature could not be generated!\n Contact administrator.\n</span>");
      }

      $malware = Malware::findBySignature($signature);

      // if there was a problem with finding malware in DB
      if (empty($malware)) {
        $this->backToHome("<span style='color:green'>Looks like this file is clean!\n</span>");
      }

      $name = $malware->name;

    // we made it!
      $this->backToHome("<span style='color:red'>It's very likely that this file is infected with $name malware!\n</span>");
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