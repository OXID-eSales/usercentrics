<?php

namespace OxidProfessionalServices\Usercentrics\Core;

use OxidProfessionalServices\Usercentrics\Service\RendererInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class ScriptRenderer extends UsercentricsScriptRenderer_parent
{
    /**
     * @return \Psr\Container\ContainerInterface
     */
    protected function getContainer()
    {
        return \OxidEsales\EshopCommunity\Internal\Container\ContainerFactory::getInstance()
            ->getContainer();
    }

    /**
     * @return ScriptRenderer
     * @throws NotFoundExceptionInterface  No entry was found for **this** identifier.
     * @throws ContainerExceptionInterface Error while retrieving the entry.
     */
    protected function getRendererService(): RendererInterface
    {
        $container = $this->getContainer();
        $renderer = $container->get('OxidProfessionalServices\Usercentrics\Service\RendererInterface');
        assert($renderer instanceof ScriptRenderer);
        return $renderer;
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
        return parent::enclose($scriptsOutput, $widget, $isAjaxRequest);
    }

    /**
     * Form output for includes.
     *
     * @param array  $includes String files to include.
     * @param string $widget   Widget name.
     *
     * @return string
     */
    protected function formFilesOutput($includes, $widget)
    {
        try {
            $service = $this->getRendererService();
        } catch (\Exception $ex) {
            return parent::formFilesOutput($includes, $widget);
        }

        return $service->formFilesOutput($includes, $widget);
    }
}
