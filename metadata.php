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
                 mit rechtlichen Anforderungen in Einklang zu bringen.</p>
                 <h2>Registrieren Sie sich deshalb jetzt bei Usercentrics</h2>  
                 <form target="_blank" method="GET" action="https://usercentrics.com/de/preise/?partnerid=16967#business-paket">
                     <input type="hidden" name="partnerid" value="16967">
                     <input style="background: #0A2; color: #fff; font-weight: bold;" type="submit" value="Jetzt registrieren">
                     <p>
                         Sollte ein anderer Mitarbeiter in Ihrem Unternehmen die Registrierung durchführen, bitte dabei zwingend die OXID Partner-ID 16967 angeben, um die Integration vollständig nutzen zu können. Zu diesem Zweck können Sie diesen Link weitergeben: https://usercentrics.com/de/preise/?partnerid=16967#business-paket
                     </p>
                 </form>
                 ',
        'en' => 'The Usercentrics Consent Management Platform (CMP) enables you to harmonize your marketing and data 
                 strategy with legal requirements.</p>
                 <h2>Register now for Usercentrics</h2>  
                 <form target="_blank" method="GET" action="https://usercentrics.com/pricing/?partnerid=16967#business-package">               
                     <input type="hidden" name="partnerid" value="16967">
                     <input style="background: #0A2; color: #fff; font-weight: bold;" type="submit" value="Register Now">
                     <p>
                         If another employee in your company registers, please make sure to enter the OXID partner ID 16967 in order to be able to fully use the integration. For that reason you can forward this link to them: https://usercentrics.com/pricing/?partnerid=16967#business-package
                     </p>
                 </form>
                 '
    ],
    'version' => '1.2.1',
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
            'group' => 'usercentrics_main',
            'name' => 'usercentricsId',
            'type' => 'str',
            'value' => ''
        ],
        [
            'group' => 'usercentrics_advanced',
            'name'  => 'smartDataProtectorActive',
            'type'  => 'bool',
            'value' => true
        ],
        [
            'group' => 'usercentrics_advanced',
            'name' => 'smartDataProtectorDeactivateBlocking',
            'type' => 'str',
            'value' => ''
        ],
        [
            'group' => 'usercentrics_advanced',
            'name' => 'usercentricsMode',
            'type' => 'select',
            'value' => Pattern\CmpV2::VERSION_NAME,
            'constraints' =>
                Pattern\CmpV1::VERSION_NAME . '|' .
                Pattern\CmpV2::VERSION_NAME . '|' .
                Pattern\CmpV2Legacy::VERSION_NAME . '|' .
                Pattern\CmpV2Tcf::VERSION_NAME . '|' .
                Pattern\CmpV2TcfLegacy::VERSION_NAME . '|' .
                Pattern\Custom::VERSION_NAME
        ],
        [
            'group' => '',
            'name'  => 'developmentAutomaticConsent',
            'type'  => 'bool',
            'value' => false
        ],
    ],

    'controllers' => [],

    'extend' => [
        JavaScriptRenderer::class => ScriptRenderer::class,
        ViewConfig::class => UsercentricsViewConfig::class
    ]
];
