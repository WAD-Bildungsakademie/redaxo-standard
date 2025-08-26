<?php

use FriendsOfRedaxo\MForm;

$mForm = new MForm();
$mForm->addTextField(9, ['label' => 'Text Navigation']);
echo $mForm->show();