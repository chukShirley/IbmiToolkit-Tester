<?php
namespace ToolkitTester;

class TestableCondition
{
    private $version;
    private $source;
    private $transportType;

    /**
     * @param ToolkitVersion $version
     * @param ToolkitSource $source
     * @param TransportType $transportType
     */
    public function __construct(ToolkitVersion $version, ToolkitSource $source, TransportType $transportType)
    {
        $this->version = $version;
        $this->source = $source;
        $this->transportType = $transportType;
    }

    /**
     * @return ToolkitVersion
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @return ToolkitSource
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @return TransportType
     */
    public function getTransportType()
    {
        return $this->transportType;
    }
}