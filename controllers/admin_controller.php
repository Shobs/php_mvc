<?php
/**
 * Admin page controller
 */
class AdminController {

  /**
   * Display admin page
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

    $expected = array( 'inputName', 'inputComment');
    $files = array( 'inputFile');
    $message = '';

    foreach( $expected AS $key ) {
      if ( !empty( $_POST[ $key ] ) ) {
        // cleaning the user inputs
        ${$key} = $this->sanitize($_POST[ $key ]);
      } else {
        ${$key} = NULL;
      }
      $message .= Utils::validate($key, ${$key});
    }

    foreach( $files AS $key ) {
      if ( !empty( $_FILES[ $key ] ) ) {
        ${$key} = $_FILES[ $key ]['tmp_name'];
      } else {
        ${$key} = NULL;
      }
      $message .= Utils::validate($key, ${$key});
    }

    if (!empty($message)) {
      $this->backToAdmin($message);
    }

    $signature = Malware::generateSignature($inputFile);

    // if something went wrong with signature generation
    if (!isset($signature) || is_null($signature)) {
      $this->backToAdmin("Signature could not be generated.\n");
    }

    // if there was a problem with saving malware to DB
    if (!Malware::create($inputName, $signature, $inputComment)) {
      $this->backToAdmin("Database error could not save malware.\n");
    }

    // we made it!
    $this->backToAdmin("$inputName has been added!\n");
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
      $this->backToAdmin("Entry id missing from request\n");
    }

    // if the id is not an int
    if(!intval($malwareID)){
      $this->backToAdmin("Entry id is not an int.\n");
    }

    $malware = Malware::findByID($malwareID);

    // malware not found
    if (!isset($malware) || is_null($malware)) {
      $this->backToAdmin("Entry could not be found\n");
    }

    // problem deleting malware from db
    if (!$malware->delete()) {
      $this->backToAdmin("Database error, entry could not be deleted!\n");
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

  /**
   * Input field validation
   * @param  [string] $string name of field to be validated
   * @return [string]         Sanitized input string
   */
  private function validate($key, $value){

    $field = str_replace('input', '', strtolower($key));
    $validate = 'validate_' . $field;

    // echo $key;
      // Making sure specific validator method exists
    if (method_exists('Utils', $validate)) {
      $message = Utils::{$validate}($value);
      if (!empty($message)) $this->backToAdmin($message);
    }
  }
}
?>