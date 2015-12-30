<?php
namespace ToolkitTester;

class TestableConditions
{
    private $conditions;

    public function __construct()
    {
        $this->conditions[] = new TestableCondition(
            new ToolkitVersion('dev'),
            new ToolkitSource('ToolkitService.php'),
            new TransportType('http')
        );

        $this->conditions[] = new TestableCondition(
            new ToolkitVersion('dev'),
            new ToolkitSource('composer'),
            new TransportType('http')
        );

        $this->conditions[] = new TestableCondition(
            new ToolkitVersion('dev'),
            new ToolkitSource('iToolkitService.php'),
            new TransportType('ibm_db2')
        );

        $this->conditions[] = new TestableCondition(
            new ToolkitVersion('dev'),
            new ToolkitSource('ToolkitService.php'),
            new TransportType('http')
        );

        $this->conditions[] = new TestableCondition(
            new ToolkitVersion('dev'),
            new ToolkitSource('iToolkitService.php'),
            new TransportType('http')
        );

        $this->conditions[] = new TestableCondition(
            new ToolkitVersion('dev'),
            new ToolkitSource('ToolkitService.php'),
            new TransportType('https')
        );

        $this->conditions[] = new TestableCondition(
            new ToolkitVersion('dev'),
            new ToolkitSource('iToolkitService.php'),
            new TransportType('https')
        );

        $this->conditions[] = new TestableCondition(
            new ToolkitVersion('dev'),
            new ToolkitSource('composer'),
            new TransportType('https')
        );

        $this->conditions[] = new TestableCondition(
            new ToolkitVersion('1.6.0'),
            new ToolkitSource('ToolkitService.php'),
            new TransportType('ibm_db2')
        );

        $this->conditions[] = new TestableCondition(
            new ToolkitVersion('1.6.0'),
            new ToolkitSource('iToolkitService.php'),
            new TransportType('ibm_db2')
        );

        $this->conditions[] = new TestableCondition(
            new ToolkitVersion('old'),
            new ToolkitSource('ToolkitService.php'),
            new TransportType('ibm_db2')
        );

        $this->conditions[] = new TestableCondition(
            new ToolkitVersion('old'),
            new ToolkitSource('iToolkitService.php'),
            new TransportType('ibm_db2')
        );

    }

    /**
     * @return array
     */
    public function getConditions()
    {
        return $this->conditions;
    }
}