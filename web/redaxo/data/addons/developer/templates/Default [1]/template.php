<?php
$v = "2509172011";
$domain = rex_yrewrite::getCurrentDomain();
$bodyClass = "bg-primary-darker";
$cookieSettings = new BootstrapCookieConsentSettings();
?>
<!DOCTYPE html>
<html lang="de">
<!--suppress HtmlRequiredTitleElement -->
<?php include rex_path::addonData('developer', 'templates/includes/head.php'); ?>
<body id="top" data-bs-spy="scroll" data-bs-target="#nav-main" data-bs-offset="100" class="<?= $bodyClass ?>">
<?php include rex_path::addonData('developer', 'templates/includes/header.php'); ?>
<main>
    REX_ARTICLE[]
</main>
<!-- Footer-->
<?php include rex_path::addonData('developer', 'templates/includes/footer.php'); ?>
<?php
$articleLegalNotice = ShRexArticleService::getLegalNoticeArticle();
$articlePrivacyPolicy = ShRexArticleService::getPrivacyPolicyArticle();
$metaHideCookieBanner = !!rex_article::getCurrent()->getValue("art_hide_cookie_banner");
?>
<script src="/node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
<script src="/node_modules/bootstrap-cookie-consent-settings/src/bootstrap-cookie-consent-settings.js"></script>
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