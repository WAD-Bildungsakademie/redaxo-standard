<?php

use FriendsOfRedaxo\MForm;

$mForm = new MForm();
$mForm->addMedialistField(1, ['label' => 'Bilder']);
$mForm->addSelectField(2, ['arrangement_1' => 'Arrangement 1', 'arrangement_2' => 'Arrangement 2'],['label' => 'Anordnung']);
echo $mForm->show();