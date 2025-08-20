<?php

class ShRexUtils
{
    public static function date(string $isoDate, string $lang): string
    {
        $timestamp = strtotime($isoDate);
        $lang = I18nUtils::lang2locale($lang);
        I18nUtils::setlocale($lang, LC_TIME);
        $zeitpunkt = "";
        if ($lang === "de_DE") {
            $zeitpunkt = strftime("%e. %B '%y", $timestamp);
        } else if ($lang === "en_US") {
            $zeitpunkt = strftime(strftime("%e %B '%Y", $timestamp));
        }
        I18nUtils::resetlocale(LC_TIME);
        return $zeitpunkt;
    }

    public static function time(int $timestamp, string $lang): string
    {
        $lang = I18nUtils::lang2locale($lang);
        I18nUtils::setlocale($lang, LC_TIME);
        $zeitpunkt = "";
        if ($lang === "de_DE") {
            $zeitpunkt = strftime("%A, %e. %B, %R Uhr", $timestamp);
        } else if ($lang === "en_US") {
            $zeitpunkt = strftime(strftime("%A, %e %B, %R", $timestamp));
        }
        I18nUtils::resetlocale(LC_TIME);
        return $zeitpunkt;
    }

    static function csvToArray($csv, $trim = false): array
    {
        $exploded = explode(",", $csv);
        if ($trim) {
            $exploded = array_map('trim', $exploded);
        }
        return $exploded;
    }

    static function csvToArticles($csv): array
    {
        $Ids = self::csvToArray($csv);
        $articles = [];
        foreach ($Ids as $id) {
            $articles[] = rex_article::get($id);
        }
        return $articles;
    }

    static function csvToShRexMediaManagerFiles($csv): array
    {
        $names = self::csvToArray($csv);
        $mediaManagerFiles = [];
        foreach ($names as $name) {
            $mediaManagerFiles[] = new ShRexMediaManagerFile($name);
        }
        return $mediaManagerFiles;
    }

    public static function seoUrlEncode(string $raw): string
    {
        $seoUrl = strtolower($raw);
        $seoUrl = str_replace([" ", ":", "(", ")", "!", "?", "—", "–", "|", "\"", "'"], "-", $seoUrl);
        $seoUrl = str_replace(["ä", "ö", "ü", "ß"], ["ae", "oe", "ue", "ss"], $seoUrl);
        $seoUrl = preg_replace("/-+/", "-", $seoUrl);
        $seoUrl = trim($seoUrl, " -\t\n\r\0\x0B");
        return urlencode($seoUrl);
    }

    public static function seoLink($article, $itemId, $title): string
    {
        return $article->getUrl() . $itemId . "/" . ShRexUtils::seoUrlEncode($title);
    }
}