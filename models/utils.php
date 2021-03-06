<?php

/**
* Utility class
* salt generator
* password hashing
* sanitation
* validation
*/
class Utils
{

    /**
     * Random salt generator
     * @param  integer $len [length of salt]
     * @return [String]       [Generated salt]
     */
    public static function generateSalt($len = 8) {
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789`~!@#$%^&*()-=_+';
        $l = strlen($chars) - 1;
        $str = '';
        for ($i = 0; $i < $len; ++$i) {
            $str .= $chars[rand(0, $l)];
        }
        return $str;
    }

    /**
     * Hashes and salts password for safe storage in database
     * @param  [String] $string     [user password]
     * @param  [String] $salt       [Generated salt]
     * @param  [string] $hashMethod [encryption to be used]
     * @return [string]             [hashed password]
     */
    public static function hashPassword($string, $salt, $hashMethod = 'sha256'){

        if (function_exists('hash') && in_array($hashMethod, hash_algos())){
            return hash($hashMethod, $salt . $string . $salt);
        }
        return sha1($salt . $string . $salt);
    }

    /**
     * Sanitizes string through html entities
     * @param  string $string input string to be sanitized
     * @return string         sanitized string
     */
    public static function mysqlEntitiesFixString($string) {
        return htmlentities(self::mysqlFixString($string));
    }

    /**
     * Sanitizes sting to make it sql safe
     * @param  string $string input string to be sanitized
     * @return string         sql safe sanitized string
     */
    public static function mysqlFixString($string) {
        if (get_magic_quotes_gpc()) $string = stripslashes($string);
        $conn = Database::getInstance();
        return $conn->real_escape_string($string);
    }

    /**
     * Sanitizes string
     * @param  string $var string to be sanitized
     * @return string      sanitized string
     */
    public static function sanitizeString($var) {
        $var = stripslashes($var);
        $var = strip_tags($var);
        $var = htmlentities($var);
        return $var;
    }

    /**
     * Sanitizes string mysql safe
     * @param  Object $connection mysqli object
     * @param  string $var        string to be sanitized
     * @return string             sanitzed string
     */
    public static function sanitizeMySQL($connection, $var) {
        $var = $connection->real_escape_string($var);
        $var = self::sanitizeString($var);
        return $var;
    }

    /**
     * helper session destroy
     * @return [type] [description]
     */
    public static function destroySessionAndData()
    {
        // session_start();
        $_SESSION = array(); // Delete all the information in the array
        // setcookie(session_name(), '', time() - 2592000, '/');
        session_destroy();
    }

    /**
     * Input field validation
     * @param  [string] $string name of field to be validated
     * @return [string]         Sanitized input string
     */
    public static function validate($key, $value){

        $field = str_replace('input', '', strtolower($key));
        $validate = 'validate_' . $field;

            // Making sure specific validator method exists
        if (method_exists('Utils', $validate)) return self::{$validate}($value);
        return "Problem with validation.  Please contact administrator.\n";
    }

    /**
     * Validates file field
     * @param  [String] $field [file field]
     * @return [Boolean]        [description]
     */
    public function validate_file($field){

        if (!file_exists($field)){
            return "File is missing.\n";
        }else if(!is_uploaded_file($field)){
            return "File has not been uploaded.\n";
        }
        return "";
    }

    /**
     * Validates email field
     * @param  [String] $field [email field]
     * @return [Boolean]        [description]
     */
    public function validate_email($field){

        $regex = '/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/iD';

        if (empty($field)) {
            return "Email is required.\n";
        }else if(!preg_match($regex, $field)){
            return "Email address is not formatted properly.\n";
        }
        return "";
    }

    /**
     * Validates password field
     * alphanumeric and -_!$\/%@#
     * @param  [String] $field [password field]
     * @return [Boolean]        [description]
     */
    public function validate_password($field){

        $regex = "/[^a-zA-Z0-9-_!$\/%@#]/";

        if (is_null($field)) {
            return "Password is required.\n";
        }else if(strlen($field) < 5){
            return "Password must be at least 5 characters.\n";
        }else if(preg_match($regex, $field)){
            return "Password is not formatted properly.\n Only a-z, A-Z, 0-9, -, _, !, $, /, %, @ and # are accepted.\n";
        }
        return "";
    }

    /**
     * Validates remember me checkbox
     * @param  [String] $field [checkbox field]
     * @return [Boolean]        [description]
     */
    public function validate_remember($field){
        return !is_null($field);
    }

    /**
     * Validates Name field
     * alphanumeric
     * @param  [type] $field [description]
     * @return [type]        [description]
     */
    public function validate_name($field){

        $regex = "/[^a-zA-Z0-9]/";

        if (is_null($field)) {
            return "Name is required.\n";
        }else if(strlen($field) < 3){
            return "Name must be at least 3 characters.\n";
        }else if(preg_match($regex, $field)){
            return "Name is not formatted properly.\n Only a-z, A-Z, and 0-9 are accepted. \n";
        }
        return "";
    }

    /**
     * Validates Comment field
     * @param  [type] $field [description]
     * @return [type]        [description]
     */
    public function validate_comment($field){

        if(strlen($field) > 0 && strlen($field) < 10){
            return "Comment must be at least 10 characters.\n";
        }
        return "";
    }
}
