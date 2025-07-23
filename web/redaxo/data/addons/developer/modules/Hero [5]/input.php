<?php

use FriendsOfRedaxo\MForm;

$mForm = new MForm();
$mForm->addMediaField(1, ['label' => 'Bild']);
$mForm->addTextField(2, ['label' => 'Text groß']);
$mForm->addTextField(3, ['label' => 'Text darunter']);
echo $mForm->show();