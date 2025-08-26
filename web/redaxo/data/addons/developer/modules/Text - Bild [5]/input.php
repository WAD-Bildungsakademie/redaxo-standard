<?php

use FriendsOfRedaxo\MForm;

$mForm = new MForm();
$mForm->addTextAreaField(3, ['label' => 'Text', 'class' => 'cke5-editor', 'data-lang' => \Cke5\Utils\Cke5Lang::getUserLang(), 'data-content-lang' => \Cke5\Utils\Cke5Lang::getOutputLang(), 'data-profile' => 'default']);
$mForm->addMediaField(1, ['label' => 'Bild']);
$mForm->addSelectField(2, ['left' => 'Links', 'right' => 'Rechts'], ['label' => 'Bild position']);
$mForm->addSelectField(6, ['6' => '6/6', '5' => '5/7', '4' => '4/8', '3' => '3/9', '2' => '2/10'], ['label' => 'Aufteilung Bild/Text']);
$mForm->addSelectField(7, ['xxl' => 'XXL', 'xl' => 'XL', 'lg' => 'L', 'md' => 'M'], ['label' => 'Maximale Breite']);
$mForm->addCheckboxField(8, ['label' => 'Getönter Hintergrund']);
echo $mForm->show();