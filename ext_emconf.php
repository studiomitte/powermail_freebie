<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Freebies via powermail',
    'description' => 'Show content elements only to users who submitted a powermail form',
    'version' => '0.1.0',
    'state' => 'beta',
    'clearcacheonload' => 1,
    'author' => 'Georg Ringer',
    'author_email' => 'gr@studiomitte.com',
    'author_company' => 'studiomitte.com',
    'constraints' => [
        'depends' => [
            'typo3' => '8.7.0-9.5.99',
            'powermail' => ''
        ],
        'conflicts' => [
        ],
        'suggests' => [],
    ],
];
