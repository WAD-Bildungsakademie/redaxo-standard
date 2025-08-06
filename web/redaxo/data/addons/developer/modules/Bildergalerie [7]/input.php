<?php

use FriendsOfRedaxo\MForm;

$mForm = new MForm();
$mForm->addMedialistField(1, ['label' => 'Bis zu 4 Bilder']);
$mForm->addSelectField(2, ['3' => '3', '4' => '4'],['label' => 'Maximal Bilder in Reihe']);
echo $mForm->show();