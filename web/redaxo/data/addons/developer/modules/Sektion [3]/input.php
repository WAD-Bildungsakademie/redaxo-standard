<?php

use FriendsOfRedaxo\MForm;

$mForm = new MForm();
$mForm->addTextAreaField(3, ['label' => 'Text', 'class' => 'cke5-editor', 'data-lang' => \Cke5\Utils\Cke5Lang::getUserLang(), 'data-content-lang' => \Cke5\Utils\Cke5Lang::getOutputLang(), 'data-profile' => 'default_block']);
$mForm->addCheckboxField(8, ['label' => 'Getönter Hintergrund']);
echo $mForm->show();