<?php

namespace OxidProfessionalServices\Usercentrics\Service\IntegrationMode;

class CmpV1 extends ScriptBuilder implements IntegrationScriptModeInterface
{
    protected $template = '<script type="application/javascript" src="https://app.usercentrics.eu/latest/main.js" 
                        id="%s" ></script>';
}
