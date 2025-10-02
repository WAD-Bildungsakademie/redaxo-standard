<?php

use FriendsOfRedaxo\MForm;

$mForm = new MForm();
$mForm->addTextAreaField(1, ['label' => 'Text über dem Formular', 'class' => 'cke5-editor', 'data-lang' => \Cke5\Utils\Cke5Lang::getUserLang(), 'data-content-lang' => \Cke5\Utils\Cke5Lang::getOutputLang(), 'data-profile' => 'default']);
$mForm->addTextAreaField(2, ['label' => 'Text nach Absendung', 'class' => 'cke5-editor', 'data-lang' => \Cke5\Utils\Cke5Lang::getUserLang(), 'data-content-lang' => \Cke5\Utils\Cke5Lang::getOutputLang(), 'data-profile' => 'default']);
echo $mForm->show();