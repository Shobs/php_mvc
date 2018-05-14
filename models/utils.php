<?php

/**
* Utility class
*/
class Utils
{

    public static function generateSalt($len = 8) {
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789`~!@#$%^&*()-=_+';
        $l = strlen($chars) - 1;
        $str = '';
        for ($i = 0; $i < $len; ++$i) {
            $str .= $chars[rand(0, $l)];
        }
        return $str;
    }

    public static function hashPassword($string, $salt, $hashMethod = 'ripemd128'){

        if (function_exists('hash') && in_array($hashMethod, hash_algos())){
            return hash($hashMethod, $salt . $string . $salt);
        }
        return sha1($salt . $string . $salt);
    }

    public static function mysqlEntitiesFixString($string) {
        return htmlentities(self::mysqlFixString($string));
    }

    public static function mysqlFixString($string) {
        if (get_magic_quotes_gpc()) $string = stripslashes($string);
        $conn = Database::getInstance();
        return $conn->real_escape_string($string);
    }


    public static function sanitizeString($var) {
        $var = stripslashes($var);
        $var = strip_tags($var);
        $var = htmlentities($var);
        return $var;
    }

    public static function sanitizeMySQL($connection, $var) {
        $var = $connection->real_escape_string($var);
        $var = self::sanitizeString($var);
        return $var;
    }


    /**
     * Validates username field
     * @param  [type] $field [description]
     * @return [type]        [description]
     */
    public function validate_file($field){

        $regex = "/[^a-zA-Z0-9_-]/";

        if (is_null($field)) {
            return "Username is required.\n";
        }else if(strlen($field) < 5){
            return "Username must be at least 5 characters.\n";
        }else if(preg_match($regex, $field)){
            return "Username is formatted properly.\n";
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
            return "Email address is formatted properly.\n";
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
            return "Password is formatted properly.\n";
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
}