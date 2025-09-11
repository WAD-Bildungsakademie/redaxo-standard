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
<header class="fixed-top">
    <div class="shadow-sm">
        <nav id="nav-main" class="navbar navbar-light bg-light navbar-expand-xl">
            <div class="container-fluid max-width-xxl">
                <a class="navbar-brand me-xl-5" href="/">
                    <img src="<?= $logo->getFileUrl() ?>" alt="Logo" class="logo"/>
                </a>
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse <?= $navPositionLeft ? "" : "justify-content-end" ?>"
                     id="navbarNav">
                    <div class="d-flex flex-column w-100">
                        <ul class="navbar-nav <?= $navPositionLeft ? "" : "ms-auto" ?>">
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
                                        $children = $category->getChildren();
                                        ?>
                                        <li class="nav-item">
                                            <a class="<?= $class ?>"
                                               href="<?= $categoryStartArticle->getUrl() ?>"><?= $category->getName() ?>
                                                <?php if (count($children) > 0) { ?>
                                                    <i class="bi bi-caret-down"></i>
                                                <?php } ?>
                                            </a>
                                        </li>
                                        <?php
                                    }
                                }
                            } ?>
                        </ul>

                        <!-- Additional content below navigation - Mobile only -->
                        <div class="mt-2">
                            <div class="px-3 d-xl-none border-top pt-2">
                                <!-- Mobile content -->
                                <p class="text-muted small mb-2">Mobile additional content</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <!-- Additional content below navbar - Desktop only -->
    </div>
    <div class="d-none d-xl-block bg-light">
        <div class="container-fluid max-width-xxl">
            <div class="text-center py-2">
                <p class="text-muted small mb-0">Desktop additional content</p>
            </div>
        </div>
    </div>
</header>