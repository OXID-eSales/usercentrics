<?php

declare(strict_types=1);

use OxidEsales\Eshop\Core\ViewConfig;
use OxidEsales\Eshop\Core\ViewHelper\JavaScriptRenderer;
use OxidProfessionalServices\Usercentrics\Core\ViewConfig as UsercentricsViewConfig;
use OxidProfessionalServices\Usercentrics\Core\ScriptRenderer;

$sMetadataVersion = '2.1';
$aModule = [
    'id' => 'oxps/usercentrics',
    'title' => 'Usercentrics Cookie Management',
    'description' => [
        'de' => 'Die Usercentrics Consent Management Platform (CMP) ermöglicht Ihnen, Ihre Marketing- und Datenstrategie
                 mit rechtlichen Anforderungen in Einklang zu bringen.',
        'en' => 'The Usercentrics Consent Management Platform (CMP) enables you to harmonize your marketing and data 
                 strategy with legal requirements.'
    ],
    'version' => '0.1',
    'author' => 'OXID Professional Services',
    'events' => [],

    'templates' => [],
    'blocks' => [
            [
                'template' => 'layout/base.tpl',
                'block' => 'base_js',
                'file' => '/views/blocks/base_js.tpl'
            ],
            [
                'template' => 'layout/base.tpl',
                'block' => 'head_meta_description',
                'file' => 'views/blocks/head_meta_description.tpl'
            ],
    ],

    'settings' => [
        [
            'group' => 'usercentrics_advanced',
            'name'  => 'smartDataProtectorActive',
            'type'  => 'bool',
            'value' => true
        ],
        [
            'group' => 'usercentrics_advanced',
            'name'  => 'usercentricsId',
            'type'  => 'str',
            'value' => '3j0TmWxNS'
        ]
    ],

    'controllers' => [],

    'extend' => [
        JavaScriptRenderer::class => ScriptRenderer::class,
        ViewConfig::class => UsercentricsViewConfig::class
    ]

];
