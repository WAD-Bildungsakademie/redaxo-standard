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
if ($teaserCount % 3 == 0) {
    $colSize = 4;
} else if ($teaserCount % 2 == 0) {
    $colSize = 6;
}
?>
<section class="module module-f0cba8 bg-light">
    <div class="container-fluid max-width-xxl">
        <?php if ($headline) { ?>
            <h2 class="text-center"><?= $headline ?></h2>
        <?php } ?>
        <div class="row">
            <?php
            foreach ($teasers as $teaser) {
                $linkedArticle = null;
                if (isset($teaser->link)) {
                    $linkedArticle = rex_article::get($teaser->link->id);
                }
                ?>
                <div class="col-12 col-md-<?= $colSize ?> mb-4">
                    <?php if ($linkedArticle) { ?>
                    <a href="<?= $linkedArticle->getUrl() ?>" class="text-decoration-none text-body">
                        <?php } ?>
                        <div class="card h-100 border-1 border-light-subtle">
                            <div class="card-body text-center">
                                <div class="bi bi-<?= $teaser->icon ?> icon"></div>
                                <h3 class="card-title mt-0"><?= $teaser->headline ?></h3>
                                <div class="card-text"><?= $teaser->text ?></div>
                            </div>
                        </div>
                        <?php if ($linkedArticle) { ?>
                    </a>
                <?php } ?>
                </div>
            <?php } ?>
        </div>
    </div>
</section>