<?php
/**
 * Author: Stefan Haack (https://shaack.com)
 * Date: 2025-07-24
 */
/** @var rex_article_slice $slice */
$slice = $this->getCurrentSlice();
$navigation = $slice->getValue(9);
$id = EncryptionUtils::stringToHtmlId($navigation);
if (rex::isBackend()) {
    echo "Sektion \"" . $navigation . "\"";
} else {
?>
<section class="module module-0805ef mb-0 pt-0">
    <div class="anchor" <?= $navigation ? "id='" . $id . "'" : "" ?>></div>
</section>
<?php } ?>