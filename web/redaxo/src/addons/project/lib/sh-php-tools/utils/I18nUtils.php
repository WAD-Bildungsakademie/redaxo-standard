<?php

class I18nUtils
{
    public static string $currentLocale; // set below with `I18nUtils::$currentLocale = setlocale(LC_ALL, 0);`

    public static function setLocale($localeOrLang, $category = LC_ALL): void
    {
        $locale = self::lang2locale($localeOrLang);
        if ($locale === "de_DE") {
            $locale = "de_DE.UTF-8";
        }
        setlocale($category, $locale);
    }

    public static function resetLocale($category = LC_ALL)
    {
        setlocale($category, self::$currentLocale);
    }


    public static function lang2locale($lang): string
    {
        if ($lang == "de") {
            return "de_DE";
        } else if ($lang == "en") {
            return "en_US";
        } else {
            return $lang;
        }
    }
}

I18nUtils::$currentLocale = setlocale(LC_ALL, 0);