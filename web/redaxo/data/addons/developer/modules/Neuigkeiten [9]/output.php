<?php

// global $og;
// $og = "HELLO WORLD";

$article = rex_article::getCurrent();
$table = "REX_VALUE[1]";
$blogMode = !!"REX_VALUE[2]";
$category = urldecode(rex_request::get("category", "string"));
$q = urldecode(rex_request::get("q", "string"));
$postings = BlogService::getEntries($table, $category, $q);
/** @noinspection PhpConditionAlreadyCheckedInspection */
if ($table) {
    $postingId = rex_request::get("id", "int");
    if(!$postingId) {
        global $articleDbId;
        // error_log("articleDbId: " . $articleDbId);
        if($articleDbId) {
            $postingId = $articleDbId;
        }
    }
    $categories = BlogService::getCategories($table);
    if ($postingId) {
        $posting = BlogService::getEntry($table, $postingId);
    }
    ?>

    <section id="blog" class="blog">
        <div class="container" data-aos="fade-up">

            <div class="row">

                <div class="col-lg-8 entries">

                    <?php if ($postingId) {
                        // write some open graph data
                        $ogData = [
                            "title" => $posting["headline"],
                            "description" => $posting["introText"]];
                        ?>

                        <article class="entry entry-single">
                            <?php

                            if ($posting["image"]) {
                                $image = new ShRexMediaManagerFile($posting["image"]);
                                $ogData["image"] = $image->getImageSrc("16_9", true);
                                ?>
                                <div class="entry-img">
                                    <img src="<?= $image->getImageSrc("16_9") ?>" alt="<?= $image->getTitle() ?>"
                                         class="img-fluid">
                                </div>
                            <?php }

                            $project = rex_addon::get('project');
                            $project->setProperty('ogData', $ogData);

                            ?>
                            <h2 class="entry-title">
                                <?= $posting["headline"] ?>
                            </h2>

                            <div class="entry-meta">
                                <ul>
                                    <?php if ($blogMode) {
                                        $autor = BlogService::getAuthor($posting["author"]);
                                        ?>
                                        <li class="d-flex align-items-center"><i
                                                    class="bi bi-person"></i> <?= $autor["name"] ?></li>
                                    <?php } ?>
                                    <li class="d-flex align-items-center"><i class="bi bi-clock"></i>
                                        <time datetime="<?= $posting["postingDate"] ?>"><?= ShRexUtils::date($posting["postingDate"], "de") ?></time>
                                    </li>
                                </ul>
                            </div>

                            <div class="entry-content">
                                <p>
                                    <?= $posting["introText"] ?>
                                </p>
                                <?= $posting["text"] ?>
                            </div>

                            <div class="entry-footer">
                                <i class="bi bi-folder"></i>
                                <ul class="cats">
                                    <li>
                                        <a href="?category=<?= urlencode($posting["category"]) ?>"><?= $posting["category"] ?></a>
                                    </li>
                                </ul>
                            </div>

                        </article><!-- End blog entry -->
                        <?php if ($blogMode) { ?>
                            <?php
                            $author = null;
                            if ($posting["author"]) {
                                $author = BlogService::getAuthor($posting["author"]);
                            }
                            if($author) {
                            $authorImage = new ShRexMediaManagerFile($author["bild"]);
                            ?>

                            <div class="blog-author d-flex align-items-center">
                                <img src="<?= $authorImage->getImageSrc("social") ?>"
                                     class="rounded-circle float-left" alt="<?= $authorImage->getTitle() ?>">
                                <div>
                                    <h4><?= $author["name"] ?></h4>
                                    <div class="social-links">
                                        <?php
                                        if($author["linkTwitter"]) { ?>
                                            <a href="<?= $author["linkTwitter"] ?>"><i class="bi bi-twitter"></i></a>
                                        <?php }
                                        if($author["linkFacebook"]) { ?>
                                            <a href="<?= $author["linkFacebook"] ?>"><i class="bi bi-facebook"></i></a>
                                        <?php }
                                        if($author["linkInstagram"]) { ?>
                                            <a href="<?= $author["linkInstagram"] ?>"><i class="biu bi-instagram"></i></a>
                                        <?php } ?>
                                    </div>
                                    <p>
                                        <?= $author["kurzbeschreibung"] ?>
                                    </p>
                                </div>
                            </div><!-- End blog author bio -->
                        <?php } } ?>
                    <?php } else {
                        if ($category) {
                            ?>
                            <h2 class="mt-0">Kategorie: <?= $category ?></h2>
                            <p class="mb-4"><a href="<?= $article->getUrl() ?>">Alle Artikel anzeigen</a></p>
                        <?php } else if($q) { ?>
                            <h2 class="mt-0">Suchergebnis</h2>
                            <p class="mb-4"><a href="<?= $article->getUrl() ?>">Alle Artikel anzeigen</a></p>
                        <?php } ?>
                        <?php
                        if(empty($postings)) { ?>
                            <p>Keine Artikel gefunden</p>
                        <?php }
                        foreach ($postings as $posting) { ?>
                            <article class="entry">
                                <?php
                                if ($posting["image"]) {
                                    $postingImage = new ShRexMediaManagerFile($posting["image"]);
                                    ?>
                                    <div class="entry-img">
                                        <img src="<?= $postingImage->getImageSrc("16_9") ?>" alt=""
                                             class="img-fluid">
                                    </div>
                                <?php } ?>
                                <h2 class="entry-title">
                                    <a href="<?= ShRexUtils::seoLink($article, $posting['id'], $posting['headline']) ?>"><?= $posting["headline"] ?></a>
                                </h2>
                                <div class="entry-meta">
                                    <ul>
                                        <?php if ($blogMode) {
                                            $autor = BlogService::getAuthor($posting["author"]);
                                            if($autor) {
                                            ?>
                                            <li class="d-flex align-items-center"><i
                                                        class="bi bi-person"></i> <?= $autor["name"] ?></li>
                                        <?php } } ?>
                                        <li class="d-flex align-items-center"><i class="bi bi-clock"></i>
                                            <time datetime="<?= $posting["postingDate"] ?>"><?= ShRexUtils::date($posting["postingDate"], "de") ?></time>
                                        </li>
                                    </ul>
                                </div>
                                <div class="entry-content">
                                    <p>
                                        <?= $posting["introText"] ?>
                                    </p>
                                    <div class="read-more">
                                        <a href="<?= ShRexUtils::seoLink($article, $posting['id'], $posting['headline']) ?>">Mehr lesen</a>
                                    </div>
                                </div>
                            </article><!-- End blog entry -->
                        <?php }
                    } ?>

                    <!--
                                    <div class="blog-pagination">
                                        <ul class="justify-content-center">
                                            <li><a href="#">1</a></li>
                                            <li class="active"><a href="#">2</a></li>
                                            <li><a href="#">3</a></li>
                                        </ul>
                                    </div>
                    -->
                </div><!-- End blog entries list -->

                <div class="col-lg-4">

                    <div class="sidebar">

                        <h3 class="sidebar-title"><label for="query">Suche</label></h3>
                        <div class="sidebar-item search-form">
                            <form action="">
                                <input id="query" type="text" name="q" value="<?= $q ?>"/>
                                <button type="submit"><i class="bi bi-search"></i></button>
                            </form>
                        </div><!-- End sidebar search formn-->

                        <h3 class="sidebar-title">Kategorien</h3>
                        <div class="sidebar-item categories">
                            <ul>
                                <?php foreach ($categories as $category) {
                                    $name = $category["category"];
                                    if(!$name) {
                                        continue;
                                    }
                                    ?>
                                    <li>
                                        <a href="?category=<?= urlencode($category["category"]) ?>"><?= $name ?>
                                            <span>(<?= $category["itemCount"] ?>)</span></a></li>
                                <?php } ?>
                            </ul>
                        </div><!-- End sidebar categories-->

                        <h3 class="sidebar-title">Letzte Beiträge</h3>
                        <div class="sidebar-item recent-posts">

                            <?php $i=0; foreach ($postings as $posting) {
                                $i++;
                                if($i > 4) {
                                    break;
                                }
                                $postingImage = new ShRexMediaManagerFile($posting["image"]);
                                ?>
                                <div class="post-item clearfix">
                                    <img src="<?= $postingImage->getImageSrc("16_9") ?>" alt="">
                                    <h4>
                                        <a href="<?= ShRexUtils::seoLink($article, $posting['id'], $posting['headline']) ?>"><?= $posting["headline"] ?></a>
                                    </h4>
                                    <time datetime="<?= $posting["postingDate"] ?>"><?= ShRexUtils::date($posting["postingDate"], "de") ?></time>
                                </div>

                            <?php } ?>

                        </div><!-- End sidebar recent posts-->
                        <!--
                                            <h3 class="sidebar-title">Tags</h3>
                                            <div class="sidebar-item tags">
                                                <ul>
                                                    <li><a href="#">App</a></li>
                                                    <li><a href="#">IT</a></li>
                                                    <li><a href="#">Business</a></li>
                                                    <li><a href="#">Mac</a></li>
                                                    <li><a href="#">Design</a></li>
                                                    <li><a href="#">Office</a></li>
                                                    <li><a href="#">Creative</a></li>
                                                    <li><a href="#">Studio</a></li>
                                                    <li><a href="#">Smart</a></li>
                                                    <li><a href="#">Tips</a></li>
                                                    <li><a href="#">Marketing</a></li>
                                                </ul>
                                            </div>
                        -->
                    </div><!-- End sidebar -->

                </div><!-- End blog sidebar -->

            </div>

        </div>
    </section><!-- End Blog Section -->
    <?php
}