<?php
namespace ToolkitTester;

class TransportType
{
    private $transportType;

    public function __construct($transportType)
    {
        $allowedValues = ['ibm_db2','odbc','http','https'];

        if (!in_array($transportType,$allowedValues))
        {
            throw new \Exception('Invalid transport type '.$transportType);
        }

        $this->transportType = $transportType;
    }

    public function getTransportType()
    {
        return $this->transportType;
    }

    public function isHttp()
    {
        return $this->transportType === 'http';
    }

    public function isHttps()
    {
        return $this->transportType === 'https';
    }

    public function isIbmDb2()
    {
        return $this->transportType === 'ibm_db2';
    }

    public function isOdbc()
    {
        return $this->transportType === 'odbc';
    }
}