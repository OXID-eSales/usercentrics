<?php

declare(strict_types=1);

use OxidEsales\Eshop\Core\ViewHelper\JavaScriptRenderer;
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
            [ 'template' => 'layout/base.tpl', 'block' => 'base_js',     'file' => '/views/blocks/base_js.tpl' ],
    ],

    'settings' => [
        [
            'group' => 'usercentrics_base',
            'name'  => 'js_service_map',
            'type'  => 'aarr',
            'value' => [],
        ],
    ],

    'controllers' => [],

    'extend' => [
        JavaScriptRenderer::class => ScriptRenderer::class
    ]

];
