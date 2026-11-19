<?php

use Composer\InstalledVersions;

/** @var array $EM_CONF */
/** @var string $_EXTKEY */
$EM_CONF[$_EXTKEY] = [
    'title' => 'group_access',
    'description' => 'Allows to limit extbase actions ba frontend user group',
    'version' => InstalledVersions::getPrettyVersion('andersundsehr/group_access'),
    'constraints' => [
        'depends' => [
            'typo3' => '13.0.0-14.4.99',
        ],
    ],
    'autoload' => [
        'psr-4' => [
            'AUS\\GroupAccess\\' => 'Classes/',
        ],
    ],
];
