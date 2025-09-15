<?php
/**
 * Author: Stefan Haack (https://shaack.com)
 */
/** @var rex_article_slice $slice */
$slice = $this->getCurrentSlice();
$text = $slice->getValue(3);
$bgGray = $slice->getValue(8);
?>
<section class="module module-216e58 <?= $bgGray ? "bg-gray" : "" ?>">
    <div class="container-fluid max-width-xl">
        <div class="max-width-md mx-auto"><?= $text ?></div>
    </div>
</section>