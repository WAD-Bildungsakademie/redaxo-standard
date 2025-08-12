<?php

$mForm = MForm::factory();
$mForm->addTextField(1, ["label" => "Überschrift"]);
$mForm->addTextField(2, ["label" => "Tabelle"]);
$mForm->addLinkField(1, ["label" => "Zielseite"]);
echo $mForm->show();