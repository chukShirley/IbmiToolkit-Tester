<?php
namespace ToolkitTester;

class ToolkitVersion
{
    private $version;

    public function __construct($version)
    {
        $allowedValues = array('dev', '1.6.0', 'old');
        if (!in_array($version,$allowedValues))
        {
            throw new \InvalidArgumentException("Invalid toolkit version value.");
        }

        $this->version = $version;
    }

    public function getVersion()
    {
        return $this->version;
    }
}