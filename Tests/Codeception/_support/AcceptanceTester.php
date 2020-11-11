<?php

namespace OxidProfessionalServices\Usercentrics\Tests\Codeception;

use OxidEsales\Codeception\Admin\AdminLoginPage;

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

    /**
     * Define custom actions here
     */
    /**
     * @return \OxidEsales\Codeception\Admin\AdminPanel
     */
    public function openAdminLoginPage()
    {
        $I = $this;
        $adminPanel = new AdminLoginPage($I);
        $I->amOnPage($adminPanel->URL);

        return $adminPanel;
    }
}
