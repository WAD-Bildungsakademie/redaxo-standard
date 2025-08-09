<?php
/**
 * Author: Stefan Haack (https://shaack.com)
 * Date: 2024-07-24
 */
/** @var rex_article_slice $slice */
$slice = $this->getCurrentSlice();
$media = null;
$url = null;
if ($slice->getMedia(1)) {
    $media = new ShRexMediaManagerFile($slice->getMedia(1));
    $url = $media->getImageSrc("large_4_3");
}
?>
<section class="module module-7bc9e6">
    <div class="container-fluid max-width-xxl mx-auto">
        <div class="row">
            <div class="col-md">
                <div class="text px-1">
                    <h1 class="text-large"><?= $slice->getValue(2) ?></h1>
                    <div class="text-small"><?= $slice->getValue(3) ?></div>
                </div>
            </div>
            <div class="col-md">
                <img src="<?= $url ?>" alt=""/>
            </div>
        </div>
    </div>
</section>