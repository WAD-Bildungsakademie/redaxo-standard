<?php
/**
 * Author: Stefan Haack (https://shaack.com)
 * Date: 2025-07-24
 */
/** @var rex_article_slice $slice */
$slice = $this->getCurrentSlice();
$media = $slice->getMedia(1) ? new ShRexMediaManagerFile($slice->getMedia(1)) : null;
$mediaPlacement = $slice->getValue(2);
$text = $slice->getValue(3);
$split = $slice->getValue(6);
$maxWidth = $slice->getValue(7);
$bgGray = $slice->getValue(8);

$colText = '<div class="col-md-' . 12 - intval($split) . '"><div class="max-width-md">'. $text .'</div></div>';
$colImage = '';
if($media) {
    $colImage = '<div class="col-md-' . $split . '"><img src="' . $media->getImageSrc("medium_4_3") . '" class="img-fluid mb-3 shadow-img image-rounded slide-in slide1-in-' . $mediaPlacement . '" alt="' . $media->getTitle() . '"/></div>';
}
?>
<section class="module module-2bd592 <?= $bgGray ? "bg-gray" : "" ?>">
    <div class="container-fluid max-width-<?= $maxWidth ?>">
        <div class="row align-items-center">
            <?php if($mediaPlacement == 'left'): ?>
                <?= $colImage ?>
                <?= $colText ?>
            <?php else: ?>
                <?= $colText ?>
                <?= $colImage ?>
            <?php endif ?>
        </div>
    </div>
</section>