<?php

namespace OxidProfessionalServices\Usercentrics\Tests\Codeception\Support;

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

    public function setUsercentricsId(string $usercentricsId): void
    {
        $this->saveConfStringVar('usercentricsId', $usercentricsId);
    }

    public function setUsercentricsMode(string $mode): void
    {
        $this->saveConfStringVar('usercentricsMode', $mode);
    }

    public function setSmartDataProtectorDeactivateBlocking(string $value): void
    {
        $this->saveConfStringVar('smartDataProtectorDeactivateBlocking', $value);
    }

    private function saveConfStringVar(string $sVarName, string $sVarVal): void
    {
        $moduleSettingsService = $this->getServiceFromContainer(ModuleSettingServiceInterface::class);
        $moduleSettingsService->saveString($sVarName, $sVarVal, Module::MODULE_ID);
    }

    public function setDevelopmentAutomaticConsent(bool $value): void
    {
        $this->saveConfBoolVar('developmentAutomaticConsent', $value);
    }

    public function setSmartDataProtectorActive(bool $value): void
    {
        $this->saveConfBoolVar('smartDataProtectorActive', $value);
    }

    private function saveConfBoolVar(string $sVarName, bool $sVarVal): void
    {
        $moduleSettingsService = $this->getServiceFromContainer(ModuleSettingServiceInterface::class);
        $moduleSettingsService->saveBoolean($sVarName, $sVarVal, Module::MODULE_ID);
    }

    /**
     * Open shop first page.
     */
    public function openShop(): Home
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
