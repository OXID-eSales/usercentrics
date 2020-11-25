<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidProfessionalServices\Usercentrics\Service\Configuration;

use OxidProfessionalServices\Usercentrics\DataObject\Configuration;

interface ConfigurationDaoInterface
{
    public function getConfiguration(): Configuration;
    public function putConfiguration(Configuration $configuration): void;
}
