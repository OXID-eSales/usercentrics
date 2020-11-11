<?php


namespace OxidProfessionalServices\Usercentrics\Service;

use OxidProfessionalServices\Usercentrics\DataObject\Configuration;

interface ConfigurationAccess
{
    public function getConfiguration(): Configuration;
    public function putConfiguration(Configuration $configuration): void;
}
