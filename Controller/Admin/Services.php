<?php

namespace OxidProfessionalServices\Usercentrics\Controller\Admin;

use OxidEsales\Eshop\Application\Controller\Admin\AdminDetailsController;

class Services extends AdminDetailsController
{
    public function render(): string
    {
        return "oxps_cookieconsent_services.tpl";
    }
}