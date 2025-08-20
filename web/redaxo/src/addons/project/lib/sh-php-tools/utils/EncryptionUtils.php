<?php

class EncryptionUtils
{
    /**
     * Generates a random hexadecimal string of specified length
     * @param int $length The length of the hexadecimal string to generate
     * @return string The generated hexadecimal string
     */
    public static function generateRandomHex(int $length): string
    {
        $bytes = random_bytes(ceil($length / 2));
        return substr(bin2hex($bytes), 0, $length);
    }

    public static function createHtmlId($length = 8):string
    {
        return "id-" . EncryptionUtils::generateRandomHex($length);
    }

    public static function stringToHtmlId($string): string
    {
        $string = preg_replace("/[^a-zA-Z0-9]+/", "_", $string);
        return strtolower($string);
    }
}