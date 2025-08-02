<?php

use FriendsOfRedaxo\MForm;

$mForm = new MForm();
$mForm->addMedialistField(1, ['label' => 'Bis zu 4 Bilder']);
$mForm->addSelectField(2, ['4_3' => '4/3', '3_4' => '3/4 (Portrait)', '16_9' => '16/9', '1' => 'Quadratisch'],['label' => 'Format']);
echo $mForm->show();