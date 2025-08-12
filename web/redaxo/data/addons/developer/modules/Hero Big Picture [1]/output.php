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
<section class="module module-7bba0e mask-<?= $mask ?>">
    <div class="bg-image" style="background-image: url('<?= $url ?>')">
        <div class="mask h-100">
            <div class="container-fluid h-100 max-width-xxl mx-auto">
                <div class="text-container h-100">
                    <div class="text">
                        <h1 class="display-3"><?= $slice->getValue(2) ?></h1>
                        <div class="h3"><?= $slice->getValue(3) ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>