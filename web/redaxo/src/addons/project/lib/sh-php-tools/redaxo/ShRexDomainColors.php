<?php

/**
 * Author: Stefan Haack (https://shaack.com)
 */
class ShRexDomainColors
{
    static function renderStyle(): string
    {
        $primary = ShRexMetaInfos::getValue("color_primary");
        $html = '';
        $html .= '<style id="domain-colors">';
        $html .= ':root {';
        $html .= '--bs-primary: ' . $primary . ';';
        $html .= '--bs-primary-rgb: ' . ColorUtils::hex2rgb($primary) . ';';
        $html .= '--bs-link-color: ' . $primary . ';';
        $html .= '--bs-link-color-rgb: ' . ColorUtils::hex2rgb($primary) . ';';
        $html .= '--bs-link-hover-color: ' . ColorUtils::darkenColor($primary, 15) . ';';
        $html .= '--bs-link-hover-color-rgb: ' . ColorUtils::hex2rgb(ColorUtils::darkenColor($primary, 15)) . ';';


        /*
        if (isset($domainColors['secondary'])) {
            echo '--bs-secondary: ' . $domainColors['secondary'] . ';';
            echo '--bs-secondary-rgb: ' . ColorUtils::hex2rgb($domainColors['secondary']) . ';';
        }
        */
        $html .= '}';

        // Add specific overrides for components that don't use CSS custom properties
        $html .= self::renderElementsStyle("primary", $primary);
        $html .= '</style>';
        return $html;
    }

    /**
     * @param mixed $primary
     * @return void
     */
    public static function renderElementsStyle($name, mixed $primary): string
    {
        $html = '';
        $html .= '.btn-' . $name . ' { background-color: ' . $primary . '; border-color: ' . $primary . '; }';
        $html .= '.btn-' . $name . ':hover { background-color: ' . ColorUtils::darkenColor($primary, 15) . '; border-color: ' . ColorUtils::darkenColor($primary, 15) . '; }';
        $html .= '.bg-' . $name . ' { background-color: ' . $primary . ' !important; }';
        $html .= '.text-' . $name . ' { color: ' . $primary . ' !important; }';
        $html .= '.border-' . $name . ' { border-color: ' . $primary . ' !important; }';
        return $html;
    }

}