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

}