<?php

namespace OxidProfessionalServices\Usercentrics\Service\IntegrationMode;

class CmpTcf extends ScriptBuilder implements IntegrationScriptModeInterface
{
    protected $template = '<script id="usercentrics-cmp"
                                data-settings-id="%s"
                                src="https://app.usercentrics.eu/browser-ui/latest/bundle.js"
                                data-tcf-enabled
                                defer></script>';
}
