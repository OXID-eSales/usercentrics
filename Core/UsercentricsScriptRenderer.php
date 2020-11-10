<?php

namespace OxidProfessionalServices\Usercentrics\Core;

class UsercentricsScriptRenderer extends UsercentricsScriptRenderer_parent
{
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
        if ($scriptsOutput) {
            if ($widget && !$isAjaxRequest) {
                $scriptsOutput = "window.addEventListener('load', function() { $scriptsOutput }, false )";
            }

            return "<script type='text/javascript'>$scriptsOutput</script>";
        }
        return "";
    }

    /**
     * Form output for includes.
     *
     * @param array<array<string>>  $includes String files to include.
     * @param string $widget   Widget name.
     *
     * @return string
     */
    protected function formFilesOutput($includes, $widget)
    {
        if (!count($includes)) {
            return '';
        }

        ksort($includes); // Sort by priority.
        $usedSources = [];
        $widgets = [];
        $widgetTemplate = "WidgetsHandler.registerFile('%s', '%s');";
        $scriptTemplate = '<script type="text/javascript" src="%s"></script>';
        foreach ($includes as $priority) {
            foreach ($priority as $source) {
                if (!in_array($source, $usedSources)) {
                    $widgets[] = sprintf(($widget ? $widgetTemplate : $scriptTemplate), $source, $widget);
                    $usedSources[] = $source;
                }
            }
        }
        $output = implode(PHP_EOL, $widgets);
        if ($widget && !empty($output)) {
            $output = <<<HTML
<script type='text/javascript'>
    window.addEventListener('load', function() {
        $output
    }, false)
</script>
HTML;
        }

        return $output;
    }
}
