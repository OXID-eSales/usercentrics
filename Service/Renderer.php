<?php

declare(strict_types=1);

namespace OxidProfessionalServices\Usercentrics\Service;

use Exception;

class Renderer implements RendererInterface
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
     */
    public function formFilesOutput(array $pathGroups, string $widget): string
    {
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

        if ($widget) {
            throw new Exception("Widgets are not yet supported");
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
            $type = '';
            $src = ' src="' . $source . '"';

            $service = $this->scriptServiceMapper->getScriptPathService($source);
            if ($service !== null) {
                $type = ' type="text/plain"';
                $data = ' data-usercentrics="' . $service->getName() . '"';
            }
            $outputs[] = "<script{$type}{$data}{$src}></script>";
        }

        return implode(PHP_EOL, $outputs);
    }

    /**
     * @TODO ?
     */
    protected function usercentricsScriptSnippet(string $scriptsOutput, string $widget, bool $isAjaxRequest): string
    {
        //ask service for service-name of the script
        //create data attribute with the service name

        if ($scriptsOutput) {
            if ($widget && !$isAjaxRequest) {
                $scriptsOutput = "window.addEventListener('load', function() { $scriptsOutput }, false )";
            }

            return "<script type='text/plain' data-service=''>$scriptsOutput</script>";
        }
        return "";
    }
}
