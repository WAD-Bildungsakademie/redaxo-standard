<?php
/**
 * Author: Stefan Haack (https://shaack.com)
 * Date: 2025-07-24
 */
/** @var rex_article_slice $slice */
$slice = $this->getCurrentSlice();
$images = ShRexUtils::csvToArray($slice->getMediaList(1));
$medias = [];
foreach ($images as $image) {
    if($image) {
        $medias[] = new ShRexMediaManagerFile($image);
    }
}

if (!function_exists('galleryImage')) {
    function galleryImage(ShRexMediaManagerFile $media, $ratio): string
    {
        return '
<a href="' . $media->getImageSrc("large_" . $ratio) . '" data-gallery="gallery-1" class="d-block">
    <figure>
        <img src="' . $media->getImageSrc("medium_" . $ratio) . '" class="img-fluid" alt="Lorem ipsum dolor sit amet"/>
        <figcaption class="visually-hidden">
               ' . $media->getTitle() .  '
        </figcaption>
    </figure>
</a>';
    }
}
?>
<div class="container-fluid max-width-xxl">
    <div class="row g-2">
        <?php if(count($medias) == 1): ?>
            <div class="col">
                <?= galleryImage($medias[0], "4_3") ?>
            </div>
        <?php elseif (count($medias) == 2): ?>
            <div class="col">
                <?= galleryImage($medias[0], "4_3") ?>
            </div>
            <div class="col">
                <?= galleryImage($medias[1], "4_3") ?>
            </div>
        <?php elseif (count($medias) == 3): ?>
            <div class="col">
                <?= galleryImage($medias[0], "3_4") ?>
            </div>
            <div class="col">
                <?= galleryImage($medias[1], "3_4") ?>
            </div>
            <div class="col">
                <?= galleryImage($medias[2], "4_3") ?>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php
global $galleryScript;
if(!$galleryScript) {
    $galleryScript = true;
    ?>
<script type="module">
    import {LightboxGallery} from "bootstrap-lightbox-gallery/src/LightboxGallery.js"

    new LightboxGallery(document.querySelectorAll("[data-gallery='gallery-1']"),
        {
            id: "gallery-45c11a", // set this, if you have multiple galleries on one page
            title: "Studio Berlin", // set the name, it will be displayed
            theme: "dark" // set to "light", if you want to display the images on light background
        })
</script>
<?php } ?>
<!--
<a href="https://via.placeholder.com/1024x768" data-gallery="gallery-1" class="d-block">
    <figure>
        <img src="https://via.placeholder.com/1024x768" class="img-fluid" alt="Lorem ipsum dolor sit amet"/>
        <figcaption class="visually-hidden">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
        </figcaption>
    </figure>
</a>
-->