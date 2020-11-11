<?php

namespace OxidProfessionalServices\Usercentrics\Core;

use OxidProfessionalServices\Usercentrics\Service\ScriptRenderer;
use OxidProfessionalServices\Usercentrics\Service\UsercentricsRenderer;

class UsercentricsScriptRenderer extends UsercentricsScriptRenderer_parent
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
     * @return ScriptRenderer|null
     */
    protected function getRendererService(): ?ScriptRenderer
    {
        $container = $this->getContainer();
        if ($container->has('OxidProfessionalServices\Usercentrics\Service\ScriptRenderer')) {
            $renderer = $container->get('OxidProfessionalServices\Usercentrics\Service\ScriptRenderer');
            assert($renderer instanceof ScriptRenderer);
            return $renderer;
        }
        return null;
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
        $service = $this->getRendererService();
        if (!isset($service)) {
            return parent::formFilesOutput($includes, $widget);
        }
        return $service->formFilesOutput($includes, $widget);
    }
}
