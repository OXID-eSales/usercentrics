<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidProfessionalServices\Usercentrics\Core;

use OxidEsales\EshopCommunity\Internal\Container\ContainerFactory;
use OxidProfessionalServices\Usercentrics\Service\RendererInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

class ScriptRenderer extends ScriptRenderer_parent
{

    protected function getContainer(): ContainerInterface
    {
        return ContainerFactory::getInstance()->getContainer();
    }

    protected function getRendererService(): RendererInterface
    {
        $container = $this->getContainer();
        /** @var RendererInterface */
        return $container->get(RendererInterface::class);
    }

    /**
     * Enclose with script tag or add in function for wiget.
     *
     * @param string $scriptsOutput javascript to be enclosed.
     * @param string $widget        widget name.
     * @param bool   $isAjaxRequest is ajax request
     *
     * @return string
     */
    protected function enclose($scriptsOutput, $widget, $isAjaxRequest)
    {
        $service = $this->getRendererService();
        return $service->encloseScriptSnippet($scriptsOutput, $widget, $isAjaxRequest);
    }

    /**
     * Form output for includes.
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
        $service = $this->getRendererService();
        return $service->formFilesOutput($includes, $widget);
    }
}
