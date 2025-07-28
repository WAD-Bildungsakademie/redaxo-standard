<?php

use FriendsOfRedaxo\MForm;

$mForm = new MForm();
$mForm->addTextField(1, ['label' => 'Text Überschrift']);
$mForm->addTextField(2, ['label' => 'Text darunter']);
$mForm->addTextField(9, ['label' => 'Text Navigation']);
$mForm->addCheckboxField(8, ['label' => 'Getönter Hintergrund']);
echo $mForm->show();