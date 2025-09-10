<?php
/**
 * @var $serviceCategory
 */
?>
<div class="footer-top">
    <div class="container-fluid max-width-xxl mx-auto">
        <div class="row align-items-center">
            <div class="col-md-auto pb-4 pb-md-0 col-address">
                <?= ShRexMetaInfos::getValue('address'); ?>
            </div>
            <div class="col-md text-md-end col-service">
                <?php
                if ($serviceCategory) {
                    $articles = $serviceCategory->getChildren();
                    foreach ($articles as $serviceArticle) {
                        if ($serviceArticle->isSiteStartArticle()) {
                            continue;
                        }
                        ?>
                        <a class="text-decoration-none me-3 text-nowrap"
                           href="<?= $serviceArticle->getUrl() ?>"><?= $serviceArticle->getName() ?></a>
                    <?php }
                } ?>
                <!--
                <span onclick="window.cookieSettings.showDialog()" role="button"
                      class="text-nowrap me-3">Cookie-Einstellungen</span>
                -->
            </div>
        </div>
    </div>
</div>
<div class="footer-bottom">
    <div class="container-fluid max-width-xxl mx-auto">
        <div class="row">
            <div class="col opacity-75">
                <div class="">
                    &copy; <?= ShRexMetaInfos::getValue("name") ?> <?= date("Y") ?>
                </div>
            </div>
        </div>
    </div>