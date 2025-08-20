<?php

// require_once "./lib/BootstrapCookieConsentSettings.php";
// require_once "lib/sh-php-tools/utils/EmailObfuscationUtils.php";

// $addon = rex_addon::get('project');

// register a custom yrewrite scheme
// rex_yrewrite::setScheme(new rex_project_rewrite_scheme());

// register yform template path
// rex_yform::addTemplatePath($addon->getPath('yform-templates'));

// register yorm class
// rex_yform_manager_dataset::setModelClass('rex_my_table', my_classname::class);

// change list of allowed mime types for mediapool
// rex_mediapool::setAllowedMimeTypes([
//     ...rex_mediapool::getAllowedMimeTypes(),
//     'json' => ['application/json'],
// ]);

rex_extension::register('OUTPUT_FILTER', function (rex_extension_point $ep) {
    if (!rex::isBackend()) {
        $content = $ep->getSubject();
        return EmailObfuscationUtils::obfuscateAllEmailsInAPage($content);
    } else {
        return $ep->getSubject();
    }
});

