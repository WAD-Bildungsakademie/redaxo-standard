<?php
/**
 * Author: Stefan Haack (https://shaack.com)
 */
/** @var rex_article_slice $slice */
$slice = $this->getCurrentSlice();
$headline = $slice->getValue(1);
$teasers = json_decode($slice->getValue(5));
$colSize = 4;
$teaserCount = count($teasers);
// calculate the row size
if($teaserCount % 3 == 0) {
    $colSize = 4;
} else if($teaserCount % 2 == 0) {
    $colSize = 6;
}
?>
<section class="module module-f0cba8 bg-light">
    <div class="container-fluid max-width-xxl">
        <?php if($headline) { ?>
            <h2 class="text-center"><?= $headline ?></h2>
        <?php } ?>
        <div class="row">
            <?php
            foreach ($teasers as $teaser) {
                ?>
                <div class="col-12 col-md-<?= $colSize ?> mb-4">
                    <div class="card h-100 shadow border-1 border-light-subtle">
                        <div class="card-body text-center">
                            <div class="bi bi-<?= $teaser->icon ?> display-4 mb-3"></div>
                            <h3 class="card-title mt-0"><?= $teaser->headline ?></h3>
                            <div class="card-text"><?= $teaser->text ?></div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>