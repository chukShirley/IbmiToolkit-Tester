<?php
namespace ToolkitTester;

class Config
{
    private $options;

    public function __construct()
    {
        $this->options = require __DIR__.'/configOptions.php';
    }

    public function getOption($key)
    {
        return $this->options[$key];
    }

    public function getToolkitOption($key)
    {
        return $this->options['toolkit_options'][$key];
    }

    public function getDb2Option($key)
    {
        return $this->options['db2_options'][$key];
    }

    public function getDb2ConnectionOption($key)
    {
        return $this->options['db2_connection_options'][$key];
    }
}