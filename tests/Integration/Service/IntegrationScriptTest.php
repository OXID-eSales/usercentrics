<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidProfessionalServices\Usercentrics\Tests\Integration\Service;

use OxidEsales\EshopCommunity\Internal\Framework\Module\Facade\ModuleSettingServiceInterface;
use OxidProfessionalServices\Usercentrics\Core\Module;
use OxidProfessionalServices\Usercentrics\Service\Integration\Pattern\CmpV1;
use OxidProfessionalServices\Usercentrics\Service\IntegrationScriptInterface;
use OxidProfessionalServices\Usercentrics\Service\ModuleSettings;
use OxidProfessionalServices\Usercentrics\Tests\Unit\UnitTestCase;
use OxidProfessionalServices\Usercentrics\Traits\ServiceContainer;

/**
 * Class RendererTest
 * @covers \OxidProfessionalServices\Usercentrics\Service\IntegrationScript
 */
class IntegrationScriptTest extends UnitTestCase
{
    use ServiceContainer;

    public function testWhiteListedScript(): void
    {
        $settingsService = $this->getServiceFromContainer(ModuleSettingServiceInterface::class);
        $settingsService->saveString(ModuleSettings::USERCENTRICS_MODE, CmpV1::VERSION_NAME, Module::MODULE_ID);
        $settingsService->saveString(ModuleSettings::USERCENTRICS_ID, 'SomeId', Module::MODULE_ID);

        $integrationScript = $this->getServiceFromContainer(IntegrationScriptInterface::class);
        $script = $integrationScript->getIntegrationScript();

        $this->assertHtmlEquals(
            '<script type="application/javascript" 
            src="https://app.usercentrics.eu/latest/main.js" 
            id="SomeId"></script>',
            $script
        );
    }
}
