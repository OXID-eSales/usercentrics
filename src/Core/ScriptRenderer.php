<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidProfessionalServices\Usercentrics\Core;

use OxidProfessionalServices\Usercentrics\Exception\WidgetsNotSupported;
use OxidProfessionalServices\Usercentrics\Service\RendererInterface;
use OxidProfessionalServices\Usercentrics\Traits\ServiceContainer;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;

class ScriptRenderer extends ScriptRenderer_parent
{
    use ServiceContainer;

    /**
     * Enclose with script tag or add in function for wiget.
     *
     * @todo: remove ServiceNotFoundException from catch when service availability during module activation fixed
     *
     * @param string $scriptsOutput javascript to be enclosed.
     * @param string $widget        widget name.
     * @param bool   $isAjaxRequest is ajax request
     *
     * @return string
     */
    protected function enclose($scriptsOutput, $widget, $isAjaxRequest)
    {
        try {
            $service = $this->getServiceFromContainer(RendererInterface::class);
            return $service->encloseScriptSnippet($scriptsOutput, $widget, $isAjaxRequest);
        } catch (WidgetsNotSupported | ServiceNotFoundException) {
            return parent::enclose($scriptsOutput, $widget, $isAjaxRequest);
        }
    }

    /**
     * Form output for includes.
     *
     * @todo: remove ServiceNotFoundException from catch when service availability during module activation fixed
     *
     * @param array<int,array<string>> $includes String files to include.
     * @param string $widget   Widget name.
     *
     * @return string
     *
     * @psalm-suppress MoreSpecificImplementedParamType
     */
    protected function formFilesOutput($includes, $widget)
    {
        try {
            $service = $this->getServiceFromContainer(RendererInterface::class);
            return $service->formFilesOutput($includes, $widget);
        } catch (WidgetsNotSupported | ServiceNotFoundException) {
            return parent::formFilesOutput($includes, $widget);
        }
    }
}
