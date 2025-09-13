<?php

use FriendsOfRedaxo\MForm;

echo MForm::factory()
    ->addTextField(1, ['label' => 'Gesamt&shy;überschrift'])
    ->addRepeaterElement(
        5,
        MForm::factory()
            ->addFieldsetArea('Teaser',
                MForm::factory()
                    ->addTextField('icon', ['label' => 'Icon'], "question-circle-fill")
                    ->addTextField('headline', ['label' => 'Überschrift'])
                    ->addTextAreaField('text', ['label' => 'Text', 'class' => 'cke5-editor', 'data-lang' => \Cke5\Utils\Cke5Lang::getUserLang(), 'data-content-lang' => \Cke5\Utils\Cke5Lang::getOutputLang(), 'data-profile' => 'default'])
            ),
        true,
        true,
        ['min' => 2, 'max' => 9]
    )
    ->addHtml("<div class='text-muted text-center'>Nutzt <a target='_blank' href='https://icons.getbootstrap.com/'>Bootstrap Icons</a> für das Feld \"Icon\"</div>")
    ->show();