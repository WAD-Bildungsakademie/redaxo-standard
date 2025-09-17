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
$currentCategory = rex_category::getCurrent();
?>
<header>
    <div class="">
        <nav id="nav-main" class="fixed-top navbar navbar-light bg-light navbar-expand-xl">
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
                            <?php
                            foreach ($rootCategories as $category) {
                                if ($category->isOnline() && $category->getId() !== $serviceCategoryId) {
                                    $categoryStartArticle = $category->getStartArticle();
                                    if ($categoryStartArticle) {
                                        $class = "nav-link";
                                        $rootActive = false;
                                        if ($categoryStartArticle->getId() === $currentArticle->getId() ||
                                                (rex_category::getCurrent() && in_array($category->getId(), rex_category::getCurrent()->getPathAsArray()))) {
                                            $class .= " active";
                                            $rootActive = true;
                                        }
                                        $children = $category->getChildren();
                                        ?>
                                        <li class="nav-item d-none d-xl-block <?= count($children) > 0 ? 'dropdown' : '' ?>">
                                            <a class="<?= $class ?>"
                                               href="<?= $categoryStartArticle->getUrl() ?>">
                                                <?= $category->getName() ?>
                                            </a>
                                        </li>
                                        <li class="nav-item d-xl-none <?= count($children) > 0 ? 'dropdown' : '' ?>">
                                            <a class="<?= $class ?> <?= $rootActive ? "show" : "" ?> <?= count($children) > 0 ? 'dropdown-toggle' : '' ?>"
                                               href="<?= $categoryStartArticle->getUrl() ?>"
                                                    <?= count($children) > 0 ? 'data-bs-toggle="dropdown" role="button" aria-expanded="' . ($rootActive ? "true" : "false") . '"' : '' ?>>
                                                <?= $category->getName() ?>
                                                <!--
                                                <?php if (count($children) > 0) { ?>
                                                    <i class="bi bi-caret-down"></i>
                                                <?php } ?>
                                                -->
                                            </a>
                                            <?php if (count($children) > 0) { ?>
                                                <ul class="dropdown-menu <?= $rootActive ? "show" : "" ?> border-0 bg-transparent">
                                                    <li>
                                                        <a class="dropdown-item"
                                                           href="<?= $categoryStartArticle->getUrl() ?>">
                                                            Übersicht
                                                        </a>
                                                    </li>
                                                    <?php foreach ($children as $child) {
                                                        if ($child->isOnline()) {
                                                            $childStartArticle = $child->getStartArticle();
                                                            if ($childStartArticle) {
                                                                $isActive = $childStartArticle->getId() === $currentArticle->getId();
                                                                ?>
                                                                <li>
                                                                    <a class="dropdown-item <?= $isActive ? 'active' : '' ?>"
                                                                       href="<?= $childStartArticle->getUrl() ?>">
                                                                        <span class="link-text"><?= $child->getName() ?></span>
                                                                    </a>
                                                                </li>
                                                            <?php }
                                                        }
                                                    } ?>
                                                </ul>
                                            <?php } ?>
                                        </li>
                                        <?php
                                    }
                                }
                            } ?>
                        </ul>
                        <?php /*
                        <!-- Additional content below navigation - Mobile only -->
                        <div class="mt-2">
                            <div class="px-3 d-xl-none border-top pt-2">
                                <!-- Mobile content -->
                                <p class="text-muted small mb-2">Mobile additional content</p>
                            </div>
                        </div>
                        */ ?>
                    </div>
                </div>
            </div>
        </nav>
        <!-- Additional content below navbar - Desktop only -->
    </div>
    <div class="d-none d-xl-block bg-light second-level-nav">
        <div class="container-fluid max-width-xxl">
            <div class="text-center">
                <?php
                if (rex_category::getCurrent()) {
                    $navigationPath = rex_category::getCurrent()->getPathAsArray();
                    $navigationLevel = count($navigationPath);
                    if ($navigationLevel > 0) {
                        if ($navigationLevel == 1) {
                            $currentChildren = rex_category::getCurrent()->getChildren();
                        } else {
                            $currentChildren = rex_category::getCurrent()->getParent()->getChildren();
                        }
                        if (count($currentChildren) > 0) {
                            ?>
                            <nav aria-label="Second level navigation">
                                <ul class="list-inline pb-2 mb-0">
                                    <?php foreach ($currentChildren as $child) {
                                        if ($child->isOnline()) {
                                            $childStartArticle = $child->getStartArticle();
                                            if ($childStartArticle) {
                                                $isActive = $childStartArticle->getId() === $currentArticle->getId();
                                                ?>
                                                <li class="list-inline-item">
                                                    <a href="<?= $childStartArticle->getUrl() ?>"
                                                       class="second-level-nav-link mx-2 pt-1 <?= $isActive ? 'active' : '' ?>">
                                                        <?= $child->getName() ?>
                                                    </a>
                                                </li>
                                            <?php }
                                        }
                                    } ?>
                                </ul>
                            </nav>
                            <?php
                        } else {
                            ?>
                                <nav></nav>
                            <?php
                        }
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <script>
        // Handle dropdown behavior for mobile navigation (TODO put this in Project.js)
        document.addEventListener('DOMContentLoaded', function() {
            // Handle dropdown toggle behavior for mobile navigation
            const dropdownToggles = document.querySelectorAll('.navbar-nav .dropdown-toggle');

            dropdownToggles.forEach(function(toggle) {
                toggle.addEventListener('click', function(e) {
                    // Close all other open dropdowns
                    dropdownToggles.forEach(function(otherToggle) {
                        if (otherToggle !== toggle) {
                            const otherDropdown = otherToggle.nextElementSibling;
                            if (otherDropdown && otherDropdown.classList.contains('show')) {
                                otherDropdown.classList.remove('show');
                                otherToggle.classList.remove('show');
                                otherToggle.setAttribute('aria-expanded', 'false');
                            }
                        }
                    });
                });
            });

            // Also handle Bootstrap's dropdown events
            const navElement = document.getElementById('navbarNav');
            if (navElement) {
                navElement.addEventListener('show.bs.dropdown', function(e) {
                    // Close all other dropdowns when a new one is about to show
                    const allDropdowns = navElement.querySelectorAll('.dropdown-menu.show');
                    allDropdowns.forEach(function(dropdown) {
                        if (dropdown !== e.target.nextElementSibling) {
                            dropdown.classList.remove('show');
                            const toggle = dropdown.previousElementSibling;
                            if (toggle) {
                                toggle.classList.remove('show');
                                toggle.setAttribute('aria-expanded', 'false');
                            }
                        }
                    });
                });
            }
        });
    </script>
</header>