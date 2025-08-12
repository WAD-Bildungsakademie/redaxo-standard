<?php

use FriendsOfRedaxo\MForm;

$mForm = new MForm();
$mForm->addMediaField(1, ['label' => 'Bild']);
$mForm->addTextField(2, ['label' => 'Text groß']);
$mForm->addTextField(3, ['label' => 'Text klein']);
$mForm->addTextField(4, ['label' => 'Action Button Text']);
$mForm->addLinkField(5, ['label' => 'Action Button Link']);
$mForm->addSelectField(6, ['' => 'Keine', 'studio' => 'Studio'], ['label' => 'Maske hinzufügen']);
echo $mForm->show();