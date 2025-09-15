<?php
use FriendsOfRedaxo\MForm;

$mForm = MForm::factory();
$mForm->addSelectField(1, ["accessibility-contrast-calculator" => "Farbkontrast Testtool"], ["label" => "Komponente"]);
echo $mForm->show();