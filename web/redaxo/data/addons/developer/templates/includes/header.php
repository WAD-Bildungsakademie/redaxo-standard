<?php
/**
 * @var $domain
 */
$rootCategories = rex_article::get($domain->getMountId())->getCategory()->getChildren();
$logoFile = ShRexMetaInfos::getValue("logo");
$logo = new ShRexMediaManagerFile($logoFile);
$navPositionLeft = ShRexMetaInfos::getValue("nav_position") === "left";
$categoryStartArticle = rex_article::getCurrent();
$serviceCategoryId = (int)ShRexMetaInfos::getValue("service_category");
$serviceCategory = null;
if ($serviceCategoryId) {
    $serviceCategory = rex_category::get($serviceCategoryId);
}
$startArticleSlices = rex_article_slice::getSlicesForArticle($categoryStartArticle->getId());
$currentArticle = rex_article::getCurrent();
?>
<nav id="nav-main" class="navbar navbar-light bg-light fixed-top navbar-expand-xl">
    <div class="container-fluid max-width-xxl">
        <a class="navbar-brand me-xl-5" href="/">
            <img src="<?= $logo->getFileUrl() ?>" alt="Logo" class="logo"/>
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse <?= $navPositionLeft ? "" : "justify-content-end" ?>" id="navbarNav">
            <ul class="navbar-nav">
                <?php /* One pager navigation */ ?>
                <?php foreach ($startArticleSlices as $slice) {
                    if ($slice->isOnline() && $slice->getValue(9)) {
                        $id = EncryptionUtils::stringToHtmlId($slice->getValue(9));
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="#<?= $id ?>"><?= $slice->getValue(9) ?></a>
                        </li>
                    <?php }
                } ?>
                <?php /* TODO Add folding menu */
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
                } ?>
            </ul>
        </div>
    </div>
</nav>