<?php
$yForm = new rex_yform();
$yForm->setDebug(false); // DEBUG
/** @noinspection PhpUndefinedConstantInspection */
$yForm->setObjectparams('form_action', rex_getUrl(REX_ARTICLE_ID, REX_CLANG_ID));
$yForm->setObjectparams('csrf_protection_error_message', 'Es ist beim Absenden des Formulars ein Fehler aufgetreten, bitte versuchen Sie es erneut.');
$yForm->setObjectparams('form_class', 'form-horizontal');
$yForm->setObjectparams('form_wrap_class', 'form-group');
$yForm->setObjectparams('real_field_names', true);

$yForm->setValueField('text', ['name', 'Name *', '', '', 'no_db']);
$yForm->setValidateField('empty', ['name', 'Bitte geben Sie Ihren Namen ein']);
$yForm->setValueField('email', ['email', 'E-Mail *', '', '', 'no_db']);
$yForm->setValidateField('email', ['email', 'Bitte geben Sie eine gültige E-Mail-Adresse ein']);
$yForm->setValidateField('empty', ['email', 'Bitte geben Sie Ihre E-Mail-Adresse ein']);
$yForm->setValueField('textarea', ['message', 'Nachricht *', '', '', 'no_db']);
$yForm->setValidateField('empty', ['message', 'Bitte geben Sie Ihre Nachricht ein']);
$yForm->setValueField('checkbox', ['privacy', 'Ich akzeptiere die Datenschutzerklärung *', '0', '1', 'no_db']);
$yForm->setValidateField('empty', ['privacy', 'Bitte akzeptieren Sie die Datenschutzerklärung']);

$yForm->setActionField('db', ['rex_contact_form']);
$yForm->setActionField('showtext', ["<p>Vielen Dank für Ihre Nachricht.</p><p>Wir werden uns zeitnah bei Ihnen melden.</p>", "", "", 1]);

echo $yForm->getForm();


?>