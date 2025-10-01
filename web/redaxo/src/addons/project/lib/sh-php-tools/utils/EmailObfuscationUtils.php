<?php

class EmailObfuscationUtils {

    private static function findEmailAddresses(string $text): array
    {
        // First, remove all HTML tags and their attributes
        $textWithoutTags = preg_replace('/<[^>]*>/', '', $text);

        preg_match_all("/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}/", $textWithoutTags, $matches);
        return $matches[0];
    }

    private static function obfuscateMailtoLinks(string $html): string
    {
        return preg_replace_callback('/<a[^>]*href=["\']mailto:([^"\']*)["\'][^>]*>(.*?)<\/a>/i',
            function ($matches) {
                $email = $matches[1];
                $label = $matches[2];
                return TextUtils::obfuscateHtml("<a href=\"mailto:$email\">$label</a>");
            }, $html);
    }

    public static function obfuscateAllEmailsInAPage(string $html): string
    {
        // First handle mailto links
        $html = self::obfuscateMailtoLinks($html);

        // Then handle plain text emails
        $emailAddresses = self::findEmailAddresses($html);
        foreach ($emailAddresses as $email) {
            $html = str_replace($email, TextUtils::obfuscateHtml($email), $html);
        }

        return $html;
    }
}