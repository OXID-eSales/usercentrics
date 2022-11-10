<?php

namespace OxidProfessionalServices\Usercentrics\Tests\Codeception;

use OxidEsales\EshopCommunity\Internal\Framework\Module\Facade\ModuleSettingServiceInterface;
use OxidProfessionalServices\Usercentrics\Core\Module;
use OxidProfessionalServices\Usercentrics\Traits\ServiceContainer;

/**
 * Inherited Methods
 *
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method void pause()
 *
 * @SuppressWarnings(PHPMD)
 */
class AcceptanceTester extends \Codeception\Actor
{
    use _generated\AcceptanceTesterActions;
    use ServiceContainer;

    /**
     * Define custom actions here
     */

    public function saveConfStringVar($sVarName, $sVarVal)
    {
        $moduleSettingsService = $this->getServiceFromContainer(ModuleSettingServiceInterface::class);
        $moduleSettingsService->saveString($sVarName, $sVarVal, Module::MODULE_ID);
    }

    public function saveConfBoolVar($sVarName, $sVarVal)
    {
        $moduleSettingsService = $this->getServiceFromContainer(ModuleSettingServiceInterface::class);
        $moduleSettingsService->saveBoolean($sVarName, $sVarVal, Module::MODULE_ID);
    }
}
