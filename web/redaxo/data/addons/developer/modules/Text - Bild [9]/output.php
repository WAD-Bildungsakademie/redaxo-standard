<?php
/**
 * Author: Stefan Haack (https://shaack.com)
 * Date: 2024-08-15
 */
/** @var rex_article_slice $slice */
$slice = $this->getCurrentSlice();
$media = $slice->getMedia(1) ? new ShRexMediaManagerFile($slice->getMedia(1)) : null;
$mediaPlacement = $slice->getValue(2);
$text = $slice->getValue(3);
$bgGray = $slice->getValue(8);

$colText = '<div class="col-md-6"><div class="max-width-md">'. $text .'</div></div>';
$colImage = '';
if($media) {
    $colImage = '<div class="col-md-6"><img src="' . $media->getImageSrc("medium_4_3") . '" class="img-fluid mb-3 shadow-img image-rounded" alt="' . $media->getTitle() . '"/></div>';
}
?>
<section class="module module-2bd592 <?= $bgGray ? "bg-gray" : "" ?>">
    <div class="container-fluid max-width-xxl">
        <div class="row">
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