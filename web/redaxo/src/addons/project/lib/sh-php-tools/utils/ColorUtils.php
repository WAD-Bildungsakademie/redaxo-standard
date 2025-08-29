<?php

class ColorUtils
{
    static function hex2rgb($hex)
    {
        $hex = str_replace('#', '', $hex);
        return implode(', ', [
            hexdec(substr($hex, 0, 2)),
            hexdec(substr($hex, 2, 2)),
            hexdec(substr($hex, 4, 2))
        ]);
    }

    static function darkenColor($hex, $percent)
    {
        $hex = str_replace('#', '', $hex);
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));

        $r = max(0, min(255, $r - ($r * $percent / 100)));
        $g = max(0, min(255, $g - ($g * $percent / 100)));
        $b = max(0, min(255, $b - ($b * $percent / 100)));

        return sprintf('#%02x%02x%02x', $r, $g, $b);
    }

    static function lightenColor($hex, $percent)
    {
        return self::darkenColor($hex, 100 - $percent);
    }


}
