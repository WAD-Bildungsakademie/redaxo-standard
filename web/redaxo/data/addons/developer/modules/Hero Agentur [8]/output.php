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
$buttonText = $slice->getValue(4);
$buttonLinkId = $slice->getLink(5);
$buttonLink = null;
if($buttonLinkId) {
    $buttonLink = rex_getUrl($buttonLinkId);
}
?>
<section class="module module-7bc9e6 d-flex align-items-center">
    <div class="container-fluid max-width-xxl mx-auto">
        <div class="row align-items-center">
            <div class="col-lg-6 pe-lg-5">
                <div class="text slide-in slide-in-left px-1">
                    <h1 class="text-large"><?= $slice->getValue(2) ?></h1>
                    <div class="text-small"><?= $slice->getValue(3) ?></div>
                    <?php if($buttonText && $buttonLink) { ?>
                        <a href="<?= $buttonLink ?>" class="btn btn-white rounded-5 px-4"><?= $buttonText ?></a>
                    <?php } ?>
                </div>
            </div>
            <div class="col-lg-6 p-lg-5">
                <div class="max-width-sm mx-auto">
                    <img class="img-fluid rounded-4" src="<?= $url ?>" alt=""/>
                </div>
            </div>
        </div>
    </div>
</section>