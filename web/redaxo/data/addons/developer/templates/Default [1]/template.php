<?php
$v = "2509082050";
$domain = rex_yrewrite::getCurrentDomain();
$currentArticle = rex_article::getCurrent();
$article = rex_article::get($currentArticle->getId());
$startArticle = rex_article::get($domain->getStartId());
$rootCategories = rex_article::get($domain->getMountId())->getCategory()->getChildren();
$serviceCategoryId = (int)ShRexMetaInfos::getValue("service_category");
$serviceCategory = null;
if ($serviceCategoryId) {
    $serviceCategory = rex_category::get($serviceCategoryId);
}
$categoryStartArticle = rex_article::getCurrent();
$isStartArticle = $categoryStartArticle->getId() === $domain->getStartId();
$articleSlices = rex_article_slice::getSlicesForArticle($categoryStartArticle->getId());
$bodyClass = "bg-primary-darker";
$cookieSettings = new BootstrapCookieConsentSettings();
$logoFile = ShRexMetaInfos::getValue("logo");
$logo = new ShRexMediaManagerFile($logoFile);
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8"/>
    <!-- <base href="/"> -->
    <title><?= ShRexMetaInfos::getValue("name") ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="description" content=""/>

    <link rel="apple-touch-icon" sizes="180x180" href="/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="48x48" href="/favicons/favicon-48.png"/>
    <link rel="icon" type="image/png" sizes="32x32" href="/favicons/favicon-32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicons/favicon-16.png">
    <link rel="manifest" href="/favicons/manifest.json">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <script src="https://cdn.jsdelivr.net/npm/es-module-shims@1.8.3/dist/es-module-shims.min.js"></script>
    <link rel="stylesheet" href="/assets/local/styles/screen.css?v=<?= $v ?>"/>
    <script type="importmap">
        {
            "imports": {
                "bootstrap-lightbox-gallery/": "/node_modules/bootstrap-lightbox-gallery/",
                "cm-web-modules/": "/node_modules/cm-web-modules/",
                "bootstrap-show-modal/": "/node_modules/bootstrap-show-modal/"
            }
        }
    </script>
    <?= ShRexDomainColors::renderStyle(); ?>
</head>
<body id="top" data-bs-spy="scroll" data-bs-target="#nav-main" data-bs-offset="100" class="<?= $bodyClass ?>">
<header>
    <nav id="nav-main" class="navbar navbar-light bg-light fixed-top navbar-expand-xl">
        <div class="container-fluid max-width-xxl">
            <a class="navbar-brand" href="/">
                <img src="<?= $logo->getFileUrl() ?>" alt="Logo" class="logo"/>
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <?php /* One pager navigation */ ?>
                    <?php foreach ($articleSlices as $slice) {
                        if ($slice->isOnline() && $slice->getValue(9)) {
                            $id = EncryptionUtils::stringToHtmlId($slice->getValue(9));
                            ?>
                            <li class="nav-item">
                                <a class="nav-link" href="#<?= $id ?>"><?= $slice->getValue(9) ?></a>
                            </li>
                        <?php }
                    } ?>
                    <?php /* TODO Multi page navigation */
                    foreach ($rootCategories as $category) {
                        if ($category->isOnline() && $category->getId() !== $serviceCategoryId) {
                            $categoryStartArticle = $category->getStartArticle();
                            if ($categoryStartArticle) {
                                $class = "nav-link";
                                if ($categoryStartArticle->getId() === $currentArticle->getId()) {
                                    $class .= " active";
                                }
                                ?>
                                <li class="nav-item">
                                    <a class="<?= $class ?>"
                                       href="<?= $categoryStartArticle->getUrl() ?>"><?= $category->getName() ?></a>
                                </li>
                                <?php
                            }
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
</header>
<main>
    REX_ARTICLE[]
</main>
<!-- Footer-->
<footer class="footer">
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
</footer>
<?php
$articleLegalNotice = ShRexArticleService::getLegalNoticeArticle();
$articlePrivacyPolicy = ShRexArticleService::getPrivacyPolicyArticle();
$metaHideCookieBanner = !!rex_article::getCurrent()->getValue("art_hide_cookie_banner");
?>
<script src="node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
<script src="node_modules/bootstrap-cookie-consent-settings/src/bootstrap-cookie-consent-settings.js"></script>
<!--
<script>
    window.cookieSettings = new BootstrapCookieConsentSettings({
        privacyPolicyUrl: "<?= $articlePrivacyPolicy ? $articlePrivacyPolicy->getUrl() : "" ?>",
        legalNoticeUrl: "<?= $articleLegalNotice ? $articleLegalNotice->getUrl() : "" ?>",
        autoShowModal: <?= $metaHideCookieBanner ? "false" : "true" ?>,
        categories: ["necessary", "statistics", "marketing", "maps"],
        lang: "de",
        postSelectionCallback: function () {
            if(window.cookieSettings.getSettings("statistics") || window.cookieSettings.getSettings("marketing") || window.cookieSettings.getSettings("maps")) {
                location.reload() // reload after selection
            }
        }
    })
</script>
-->
<script type="module">
    import {Project} from "/assets/local/src/Project.js"

    window.project = new Project()
</script>
</body>
</html>