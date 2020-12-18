<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidProfessionalServices\Usercentrics\Tests\Integration\Service;

use OxidEsales\Eshop\Core\Registry;
use OxidEsales\EshopCommunity\Tests\Integration\Internal\ContainerTrait;
use OxidProfessionalServices\Usercentrics\Service\Integration\Pattern\CmpV1;
use OxidProfessionalServices\Usercentrics\Service\IntegrationScriptInterface;
use OxidProfessionalServices\Usercentrics\Tests\Unit\UnitTestCase;

/**
 * Class RendererTest
 * @covers \OxidProfessionalServices\Usercentrics\Service\IntegrationScript
 */
class IntegrationScriptTest extends UnitTestCase
{
    use ContainerTrait;

    public function testWhiteListedScript(): void
    {
        $config = Registry::getConfig();
        /** @psalm-suppress InvalidScalarArgument fails because of wrong typehint in used oxid version */
        $config->saveShopConfVar(
            'string',
            'usercentricsId',
            'SomeId',
            1,
            'module:oxps_usercentrics'
        );
        $config->saveShopConfVar(
            'string',
            'usercentricsMode',
            CmpV1::VERSION_NAME,
            1,
            'module:oxps_usercentrics'
        );

        /** @var IntegrationScriptInterface $integrationScript */
        $integrationScript = $this->get(IntegrationScriptInterface::class);
        $script = $integrationScript->getIntegrationScript();

        $this->assertHtmlEquals(
            '<script type="application/javascript" 
            src="https://app.usercentrics.eu/latest/main.js" 
            id="SomeId"></script>',
            $script
        );
    }
}
