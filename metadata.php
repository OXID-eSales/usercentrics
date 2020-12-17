<?php

declare(strict_types=1);

use OxidEsales\Eshop\Core\ViewConfig;
use OxidEsales\Eshop\Core\ViewHelper\JavaScriptRenderer;
use OxidProfessionalServices\Usercentrics\Core\ViewConfig as UsercentricsViewConfig;
use OxidProfessionalServices\Usercentrics\Core\ScriptRenderer;
use OxidProfessionalServices\Usercentrics\Service\Integration\Pattern;

$sMetadataVersion = '2.1';
$aModule = [
    'id' => 'oxps_usercentrics',
    'title' => 'OXID Cookie Management powered by usercentrics',
    'description' => [
        'de' => 'Die Usercentrics Consent Management Platform (CMP) ermöglicht Ihnen, Ihre Marketing- und Datenstrategie
                 mit rechtlichen Anforderungen in Einklang zu bringen.',
        'en' => 'The Usercentrics Consent Management Platform (CMP) enables you to harmonize your marketing and data 
                 strategy with legal requirements.'
    ],
    'version' => '1.1.0',
    'author' => 'OXID Professional Services',
    'events' => [],

    'templates' => [],

    'blocks' => [
        [
            'template' => 'layout/base.tpl',
            'block' => 'base_js',
            'file' => 'src/views/blocks/base_js.tpl'
        ],
        [
            'template' => 'layout/base.tpl',
            'block' => 'head_meta_description',
            'file' => 'src/views/blocks/head_meta_description.tpl'
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
            'name' => 'usercentricsId',
            'type' => 'str',
            'value' => ''
        ],
        [
            'group' => 'usercentrics_advanced',
            'name' => 'usercentricsMode',
            'type' => 'select',
            'value' => 'CMPv2',
            'constraints' =>
                Pattern\CmpV1::VERSION_NAME . '|' .
                Pattern\CmpV2::VERSION_NAME . '|' .
                Pattern\CmpV2Legacy::VERSION_NAME . '|' .
                Pattern\CmpV2Tcf::VERSION_NAME . '|' .
                Pattern\CmpV2TcfLegacy::VERSION_NAME . '|' .
                Pattern\Custom::VERSION_NAME
        ],
    ],

    'controllers' => [],

    'extend' => [
        JavaScriptRenderer::class => ScriptRenderer::class,
        ViewConfig::class => UsercentricsViewConfig::class
    ]
];
