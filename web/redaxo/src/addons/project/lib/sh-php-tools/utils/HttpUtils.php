<?php

class HttpUtils
{
    public static function getCurrentUri($includeQueryString = false)
    {
        $uri = $_SERVER['REQUEST_URI'];
        if (!$includeQueryString) {
            $uri = strtok($uri, '?');
        }
        return $uri;
    }
}