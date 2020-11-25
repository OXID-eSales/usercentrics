<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

// This is acceptance bootstrap
$helper = new \OxidEsales\Codeception\Module\FixturesHelper();
$helper->loadRuntimeFixtures(dirname(__FILE__) . '/../_data/fixtures.php');
