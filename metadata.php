<?php

use OxidEsales\Eshop\Core\ViewHelper\JavaScriptRenderer;
use OxidProfessionalServices\Usercentrics\Controller;
use OxidProfessionalServices\Usercentrics\Core\UsercentricsScriptRenderer;

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

    'templates' => [
        // Admin Templates
        'oxps_cookieconsent_services.tpl'   => 'oxps/usercentrics/views/admin/tpl/oxps_cookieconsent_services.tpl',
        'oxps_cookieconsent_scripts.tpl'   => 'oxps/usercentrics/views/admin/tpl/oxps_cookieconsent_scripts.tpl',
    ],

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

    'controllers' => [
        // Admin Controllers
        'oxps_cookieconsent_services'   => Controller\Admin\Services::class,
        'oxps_cookieconsent_scripts'   => Controller\Admin\Scripts::class,
    ],

    'extend' => [
        JavaScriptRenderer::class => UsercentricsScriptRenderer::class
    ]

];
