<?php

class TextUtils
{
    public static function p2nl(string $text): string
    {
        $text = str_replace("</p>", "\n", str_replace("<p>", "", $text));
        return preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $text);
    }

    public static function removeNewlines(string $text): string
    {
        return preg_replace("/(\n\s*)/", "", $text);
    }

    public static function Csv2Table($csv): string
    {
        $trs = "";
        $rows = explode("\n", $csv);
        foreach ($rows as $row) {
            $fields = explode(";", $row);
            $tds = "";
            foreach ($fields as $field) {
                $field = trim($field);
                $tds .= "<td>$field</td>";
            }
            $trs .= "<tr>$tds</tr>";
        }
        return "<table>$trs</table>";
    }

    /** use this to obfuscate email addresses in HTML. */
    public static function obfuscateHtml(string $html): string
    {
        $encoded = base64_encode($html);
        return sprintf('<script>document.write(atob(\'%s\'));</script>', $encoded);
    }

}