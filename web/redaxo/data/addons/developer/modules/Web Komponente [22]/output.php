<?php
/**
 * Author: Stefan Haack (https://shaack.com)
 */
/** @var rex_article_slice $slice */
$slice = $this->getCurrentSlice();
$component = $slice->getValue(1);
?>
<section class="module module-786e0d">
    <div class="container-fluid max-width-xl">
        <?php
        if ($component == "accessibility-contrast-calculator") {
            ?>
            <accessibility-contrast-calculator bg="#bee2b1" fg="#333333"></accessibility-contrast-calculator>
            <script type="module">
                import {
                    AccessibilityContrastCalculator
                } from "/node_modules/accessibility-contrast-calculator/src/AccessibilityContrastCalculator.js";

                const component = new AccessibilityContrastCalculator();
            </script>
        <?php } ?>
    </div>
</section>
