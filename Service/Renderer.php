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

    /**
     * @param mixed[] $includes //[ 10 => ["test.js","test2.js"] ]
     * @param string $widget widget name or if no widget selected then an empty string
     * @return string
     * see https://usercentrics.com/knowledge-hub/direct-integration-usercentrics-script-website/#Assign_data_attributes
     * psalm-suppress
     */
    public function formFilesOutput(array $includes, string $widget): string
    {
        if (!count($includes)) {
            return '';
        }

        /**
         * @var array<array<string>>
         */
        $typedIncludes = $includes;

        ksort($includes); // Sort by priority.
        /**
         * @var string[]
         */
        $scripts = [];
        foreach ($typedIncludes as $priority) {
            foreach ($priority as $source) {
                if (!in_array($source, $scripts)) {
                    $scripts[] = (string) $source;
                }
            }
        }
        if (!$widget) {
            return $this->usercentricsScriptIncludeNormal($scripts);
        }
        throw new Exception("widgets are not yet supported");
    }

    /**
    * @param string[] $includes //[ "test.js","test2.js"]
    * @return string
    * see https://usercentrics.com/knowledge-hub/direct-integration-usercentrics-script-website/#Assign_data_attributes
    */
    protected function usercentricsScriptIncludeNormal(array $includes)
    {
        $scripts = [];
        foreach ($includes as $source) {
            $serviceInfo = $this->scriptServiceMapper->scriptService($source);
            $data = "";
            $type = "";
            $src = " src=\"$source\"";
            if (isset($serviceInfo)) {
                $serviceName = $serviceInfo->getName();
                $type = ' type="text/plain"';
                $data = " data-usercentrics=\"$serviceName\"";
            }
            $scripts[] = "<script$type$data$src></script>";
        }

        return implode(PHP_EOL, $scripts);
    }
}
