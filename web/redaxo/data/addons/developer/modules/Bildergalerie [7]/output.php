<?php
/**
 * Author: Stefan Haack (https://shaack.com)
 * Date: 2025-07-24
 */
/** @var rex_article_slice $slice */
$slice = $this->getCurrentSlice();
$images = ShRexUtils::csvToArray($slice->getMediaList(1));
$maxImagesPerRow = $slice->getValue(2);
$medias = [];
foreach ($images as $image) {
    if ($image) {
        $medias[] = new ShRexMediaManagerFile($image);
    }
}

if (!function_exists('calculateImageWidths')) {

    function calculateImageWidths(array $images, int $containerWidth = 1200, int $targetHeight = 300): array
    {
        $widths = [];
        $totalRatioSum = 0;

        // Calculate sum of ratios for the row
        foreach ($images as $image) {
            $ratio = $image->getRatio();
            $totalRatioSum += $ratio;
        }

        // Calculate individual widths based on ratios
        foreach ($images as $index => $image) {
            $ratio = $image->getRatio();
            // Width = (individual ratio / sum of ratios) * container width
            $widths[$index] = round(($ratio / $totalRatioSum) * $containerWidth);
        }

        return $widths;
    }

    function renderGalleryRow(array $images): string
    {
        $widths = calculateImageWidths($images);
        $output = '<div class="gallery-row d-flex gap-2 mb-2">';

        foreach ($images as $index => $image) {
            $width = $widths[$index];
            $output .= sprintf(
                '<div class="gallery-item" style="flex: %d">
                <a href="%s" data-gallery="gallery-1" class="d-block h-100">
                    <figure class="m-0 h-100">
                        <img src="%s" class="img-fluid h-100 w-100 object-fit-cover" alt="%s"/>
                        <figcaption class="visually-hidden">%s</figcaption>
                    </figure>
                </a>
            </div>',
                $width,
                $image->getImageSrc("large"),
                $image->getImageSrc("medium"),
                htmlspecialchars($image->getTitle()),
                htmlspecialchars($image->getTitle())
            );
        }

        $output .= '</div>';
        return $output;
    }


}
?>
<section class="module module-64bdfd">
    <div class="container-fluid max-width-xxl">
        <div class="gallery-container">
            <?php
            // Split images into rows (1-4 images per row)
            $rows = array_chunk($medias, min($maxImagesPerRow, count($medias)));
            foreach ($rows as $row): ?>
                <?= renderGalleryRow($row) ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php
global $galleryScript;
if (!$galleryScript) {
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