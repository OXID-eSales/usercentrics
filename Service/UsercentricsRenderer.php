<?php


namespace OxidProfessionalServices\Usercentrics\Service;

use Exception;

class UsercentricsRenderer implements ScriptRenderer
{
    /**
     * @var ScriptRepository
     */
    private $repository;

    /**
     * UsercentricsRenderer constructor.
     * @param ScriptRepository $repository
     */
    public function __construct(ScriptRepository $repository)
    {
        $this->repository = $repository;
    }

    public function usercentricsScriptSnippet(string $scriptsOutput, string $widget, bool $isAjaxRequest): string
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
     * @param array $includes //[ 10 => ["test.js","test2.js"] ]
     * @param string $widget widget name or if no widget selected then an empty string
     * @return string
     * see https://usercentrics.com/de/knowledge-hub/usercentrics-skript-direkt-in-deine-website-einbinden/#Data-Attribute_vergeben
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
    * @param array<string> $includes //[ "test.js","test2.js"]
    * @return string
    * see https://usercentrics.com/de/knowledge-hub/usercentrics-skript-direkt-in-deine-website-einbinden/#Data-Attribute_vergeben
    */
    public function usercentricsScriptIncludeNormal(array $includes)
    {
        $scripts = [];
        foreach ($includes as $source) {
            $serviceInfo = $this->repository->scriptService($source);
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
