<?php
/**
 * Author: Stefan Haack (https://shaack.com)
 * Date: 2025-07-24
 */
/** @var rex_article_slice $slice */
$slice = $this->getCurrentSlice();
$navigation = $slice->getValue(9);
$bgGray = $slice->getValue(8);
$id = ShTools::stringToHtmlId($navigation);
?>
<section class="module module-0805ef <?= $bgGray ? "bg-gray" : "" ?>">
    <div class="anchor" <?= $navigation ? "id='" . $id . "'" : "" ?>></div>
    <div class="container-fluid max-width-xl">
        <h2><?= $slice->getValue(1) ?></h2>
        <div class="subheadline">
            <?= $slice->getValue(2) ?>
        </div>
    </div>
</section>