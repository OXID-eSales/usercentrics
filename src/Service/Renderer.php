<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidProfessionalServices\Usercentrics\Service;

use OxidProfessionalServices\Usercentrics\Exception\WidgetsNotSupported;

final class Renderer implements RendererInterface
{
    /**
     * @var ScriptServiceMapperInterface
     */
    private $scriptServiceMapper;

    /**
     * Renderer constructor.
     * @param ScriptServiceMapperInterface $scriptServiceMapper
     */
    public function __construct(ScriptServiceMapperInterface $scriptServiceMapper)
    {
        $this->scriptServiceMapper = $scriptServiceMapper;
    }

    /**
     * @param array<int,array<string>> $pathGroups // [ 10 => ["test.js","test2.js"] ]
     *
     * @throws WidgetsNotSupported
     */
    public function formFilesOutput(array $pathGroups, string $widget): string
    {
        if ($widget) {
            throw new WidgetsNotSupported();
        }

        if (!count($pathGroups)) {
            return '';
        }

        ksort($pathGroups); // Sort by priority.

        /** @var string[] $sources */
        $sources = [];
        foreach ($pathGroups as $priorityGroup) {
            /** @var string $onePath */
            foreach ($priorityGroup as $onePath) {
                if (!in_array($onePath, $sources)) {
                    $sources[] = (string)$onePath;
                }
            }
        }

        return $this->prepareScriptUrlsOutput($sources);
    }

    /**
     * @param array<string> $sources //[ "test.js","test2.js"]
     *
     * see https://usercentrics.com/knowledge-hub/direct-integration-usercentrics-script-website/#Assign_data_attributes
     */
    protected function prepareScriptUrlsOutput(array $sources): string
    {
        $outputs = [];

        foreach ($sources as $source) {
            $data = '';
            $type = ' type="text/javascript"';
            $src = ' src="' . $source . '"';

            $service = $this->scriptServiceMapper->getServiceByScriptUrl($source);
            if ($service !== null) {
                $type = ' type="text/plain"';
                $data = ' data-usercentrics="' . $service->getName() . '"';
            }
            $outputs[] = "<script{$type}{$data}{$src}></script>";
        }

        return implode(PHP_EOL, $outputs);
    }

    /**
     * @throws WidgetsNotSupported
     */
    public function encloseScriptSnippet(string $scriptsOutput, string $widget, bool $isAjaxRequest): string
    {
        if ($widget && !$isAjaxRequest) {
            throw new WidgetsNotSupported();
        }

        if ($scriptsOutput) {
            $snippetId = $this->scriptServiceMapper->calculateSnippetId($scriptsOutput);
            $service = $this->scriptServiceMapper->getServiceBySnippetId($snippetId);

            $serviceData = $service ? ' data-usercentrics="' . $service->getName() . '"' : '';
            $scriptType = $service ? ' type="text/plain"' : ' type="text/javascript"';

            $snippetIdData = " data-oxid=\"$snippetId\"";

            return "<script{$scriptType}{$serviceData}{$snippetIdData}>$scriptsOutput</script>";
        }
        return "";
    }
}
