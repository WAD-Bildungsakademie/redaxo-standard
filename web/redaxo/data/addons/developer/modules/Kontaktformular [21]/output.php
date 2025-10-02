<?php
$yForm = new rex_yform();
$yForm->setDebug(false); // DEBUG
/** @noinspection PhpUndefinedConstantInspection */
$yForm->setObjectparams('form_action', rex_getUrl(REX_ARTICLE_ID, REX_CLANG_ID));
$yForm->setObjectparams('csrf_protection_error_message', 'Es ist beim Absenden des Formulars ein Fehler aufgetreten, bitte versuchen Sie es erneut.');
// $yForm->setObjectparams('form_class', 'form-horizontal');
// $yForm->setObjectparams('form_wrap_class', 'form-group');
$yForm->setObjectparams('real_field_names', true);

$yForm->setValueField('text', ['name', 'Name', '', '', 'no_db']);
$yForm->setValueField('email', ['email', 'E-Mail-Adresse *', '', '', 'no_db']);
$yForm->setValidateField('type', ['email', 'email', 'Bitte geben Sie eine gültige E-Mail-Adresse ein']);
$yForm->setValidateField('empty', ['email', 'Bitte geben Sie Ihre E-Mail-Adresse ein']);
$yForm->setValueField('textarea', ['message', 'Nachricht', '', '', 'no_db']);
// $yForm->setValidateField('empty', ['message', 'Bitte geben Sie Ihre Nachricht ein']);
/*
$yForm->setValueField('checkbox', ['privacy', 'Ich akzeptiere die Datenschutzerklärung *', '0', '1', 'no_db']);
$yForm->setValidateField('empty', ['privacy', 'Bitte akzeptieren Sie die Datenschutzerklärung']);
*/
$articleDatenschutzerklaerung = rex_article::get(ShRexMetaInfos::getValue("article_privacy_policy"));
$yForm->setValueField('html', ['html', '<p>Die mit einem Sternchen (*) gekennzeichneten Felder sind Pflichtfelder 
    und müssen ausgefüllt werden. Bei der Übermittlung des Formulars gilt unsere <a target="_blank" href="' .
        $articleDatenschutzerklaerung->getUrl() . '">Datenschutzerklärung</a>.</p>']);

// $yForm->setActionField('db', ['rex_contact_form']);
$yForm->setActionField("tpl2email", ["contact_email_to_user", "email"]);
$yForm->setActionField("tpl2email", ["contact_email_to_operator", ShRexMetaInfos::getValue("contact_email")]);
$yForm->setActionField('showtext', ["<p>Vielen Dank für Ihre Nachricht.</p><p>Wir werden uns zeitnah bei Ihnen melden.</p>", "", "", 1]);

// TODO See: web/redaxo/src/addons/yform/docs/02_email.md

// echo $yForm->getForm();

?>
<section class="module module-form module-c3a99a bg-light">
    <div class="container-fluid max-width-md">
        <?= $yForm->getForm(); ?>
    </div>
</section>
