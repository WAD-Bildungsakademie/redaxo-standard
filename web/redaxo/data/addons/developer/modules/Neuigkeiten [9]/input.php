<?php

$mForm = MForm::factory();
$mForm->addTextField(1, ["label" => "Tabelle"]);
$mForm->addCheckboxField(2, ["label" => "Blog-Modus"]);
echo $mForm->show();