<?php
namespace ToolkitTester;

class ToolkitSource
{
    private $source;

    public function __construct($source)
    {
        $allowedValues = array('ToolkitService.php', 'iToolkitService.php', 'composer');
        if (!in_array($source,$allowedValues))
        {
            throw new \InvalidArgumentException("Invalid toolkit source value.");
        }

        $this->source = $source;
    }

    public function getSource()
    {
        return $this->source;
    }
}