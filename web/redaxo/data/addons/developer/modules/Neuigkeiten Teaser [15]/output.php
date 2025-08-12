<?php
$table = "REX_VALUE[2]";
$postings = BlogService::getEntries($table, null, null,4);
$article = rex_article::get("REX_LINK[1]")
?>


<section class="news-teaser">

    <div class="container">

        <h3 class="mt-0"><a href="<?= $article->getUrl() ?>">REX_VALUE[1]</a></h3>
        <div class="sidebar-item recent-posts">

            <?php foreach ($postings as $posting) {
                $postingImage = new ShRexMediaManagerFile($posting["image"]);
                ?>
                <div class="post-item clearfix">
                    <img style="<?= rex::isBackend() ? "width: 100px" : "" ?>" src="<?= $postingImage->getImageSrc("4_3") ?>" alt="">
                    <h4>
                        <a href="<?= ShRexUtils::seoLink($article, $posting['id'], $posting['headline']) ?>"><?= $posting['headline'] ?></a>
                    </h4>
                    <time datetime="<?= $posting["postingDate"] ?>"><?= ShRexUtils::date($posting["postingDate"], "de") ?></time>
                </div>
            <?php } ?>

        </div>
    </div>

</section>