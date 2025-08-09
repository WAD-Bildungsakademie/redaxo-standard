<?php

use FriendsOfRedaxo\MForm;

$mForm = new MForm();
$mForm->addMediaField(1, ['label' => 'Bild']);
$mForm->addTextField(2, ['label' => 'Text groß']);
$mForm->addTextAreaField(3, ['label' => 'Text klein']);
$mForm->addTextField(4, ['label' => 'Action Button Text']);
$mForm->addLinkField(5, ['label' => 'Action Button Link']);
echo $mForm->show();