<?php
class AdminController {

  /**
   * Display main index page
   */
  public function index() {
    // getting error messages if any
    $errorMessage = '';
    if (isset($_SESSION['err_mess'])) {
      $errorMessage = $_SESSION['err_mess'];
      unset($_SESSION['err_mess']);
    }

    // json encode malwares and hide in data-malwares
    // so we can grab it in javascript and parse into table
    $malwares = json_encode(Malware::all());

    require_once('views/admin/index.php');
  }

  /**
   * Add malware info to database
   */
  public function add(){

    if (!$_FILES) {
      $this->backToAdmin('File is missing.');
    }

    $expected = array( 'inputName', 'inputComment');
    $files = array( 'inputFile');

    foreach( $expected AS $key ) {
      if ( !empty( $_POST[ $key ] ) ) {
        // cleaning the user inputs
        ${$key} = $this->sanitize($_POST[ $key ]);
      } else {
        ${$key} = NULL;
      }
    }

    foreach( $files AS $key ) {
      if ( !empty( $_FILES[ $key ] ) ) {
        ${$key} = $_FILES[ $key ]['tmp_name'];
      } else {
        ${$key} = NULL;
      }
    }

    // if we are missing inputs return
    if (is_null($inputName) || is_null($inputFile)) {
      $this->backToAdmin('Missing malware name.');
    }

    // if the name of file is not a string
    if(!strval($inputName)){
      $this->backToAdmin('Malware name is not a string.');
    }

    $signature = Malware::generateSignature($inputFile);

    // if something went wrong with signature generation
    if (!isset($signature) || is_null($signature)) {
      $this->backToAdmin('Signature could not be generated');
    }

    // if there was a problem with saving malware to DB
    if (!Malware::create($inputName, $signature, $inputComment)) {
      $this->backToAdmin('Database error could not save malware');
    }

    // we made it!
    $this->backToAdmin("$nameInput has been added!");
  }

  /**
   * Deletes malware signature from database
   */
  public function delete(){

    $expected = array( 'malwareID');

    foreach( $expected AS $key ) {
      if ( !empty( $_POST[ $key ] ) ) {
        ${$key} = $this->sanitize($_POST[ $key ]);
      }
      else {
        ${$key} = NULL;
      }
    }

    // if we are missing malware id
    if (is_null($malwareID)) {
      $this->backToAdmin('Entry id missing from request');
    }

    // if the id is not an int
    if(!intval($malwareID)){
      $this->backToAdmin('Entry id is not an int.');
    }

    $malware = Malware::findByID($malwareID);

    // malware not found
    if (!isset($malware) || is_null($malware)) {
      $this->backToAdmin('Entry could not be found');
    }

    // problem deleting malware from db
    if (!$malware->delete()) {
      $this->backToAdmin('Database error, entry could not be deleted!');
    }

    //We made it!!
    $this->backToAdmin();
  }

  /**
   * Redirects to login page with error message
   * @param  [string] $message Error message to be saved to session
   */
  private function backToAdmin($message = null){
    $_SESSION['err_mess'] = $message;
    header("Location:../admin");
    die();
  }

  /**
   * String sanitization for safe mysql query use
   * @param  [string] $string Unsanitized form input string
   * @return [string]         Sanitized input string
   */
  private function sanitize($string){
    return Utils::mysqlEntitiesFixString($string);
  }

}
?>