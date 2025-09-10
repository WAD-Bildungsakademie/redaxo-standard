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