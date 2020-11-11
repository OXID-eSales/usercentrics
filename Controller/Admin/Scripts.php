<?php

namespace OxidProfessionalServices\Usercentrics\Controller\Admin;

use OxidEsales\Eshop\Application\Controller\Admin\AdminDetailsController;

class Scripts extends AdminDetailsController
{
    public function render(): string
    {
        return "oxps_cookieconsent_scripts.tpl";
    }
}