<?php


namespace OxidProfessionalServices\Usercentrics\Service\IntegrationMode;


class ScriptBuilder implements IntegrationScriptModeInterface
{
    /** @var string */
    private $id;

    /** @var string */
    protected $template = "";

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function getHtml(): string
    {
        return $this->buildHtml($this->template, $this->id);
    }

    public function buildHtml(string $template, string $id): string
    {
        return sprintf($template, $id);
    }
}
