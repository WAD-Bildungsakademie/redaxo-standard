<?php
/**
 * Author: Stefan Haack (https://shaack.com)
 * Date: 2024-07-24
 */
/** @var rex_article_slice $slice */
$slice = $this->getCurrentSlice();
$media = null;
$url = null;
if($slice->getMedia(1)) {
    $media = new ShRexMediaManagerFile($slice->getMedia(1));
    $url = $media->getImageSrc("large_4_3");
}
$mask = $slice->getValue(6);
?>
<h1><?= $slice->getValue(2) ?></h1>
<p><?= $slice->getValue(3) ?></p>
<!--
<section class="module module-7bba0e mask-<?= $mask ?>">
    <div class="bg-image" style="background-image: url('<?= $url ?>')">

    </div>
</section>
-->