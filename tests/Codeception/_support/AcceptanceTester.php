<?php

namespace OxidProfessionalServices\Usercentrics\Tests\Codeception;

use Codeception\Step\Action;
use OxidEsales\Codeception\Page\Home;
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

    /**
     * Open shop first page.
     */
    public function openShop()
    {
        $I = $this;
        $homePage = new Home($I);
        $I->amOnPage($homePage->URL);

        return $homePage;
    }

    public function waitForPageLoad(int $timeout = 60): void
    {
        if (getenv('THEME_ID') !== 'apex') {
            $this->getScenario()->runStep(new Action('waitForPageLoad', func_get_args()));
        }
    }
}
