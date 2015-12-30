<?php
namespace ToolkitTester;

use ToolkitApi\Toolkit;
use Exception;
use ToolkitService;

class Tester
{
    /**
     * @var Toolkit
     */
    private $toolkitObject;

    /**
     * @var ToolkitVersion
     */
    private $toolkitVersion;

    /**
     * @var ToolkitSource
     */
    private $toolkitSource;

    private $dbConn;
    private $toolkitSettings;
    private $namingMode;

    /**
     * @var Config
     */
    private $config;

    /**
     * @var TransportType
     */
    private $transportType;

    public function __construct()
    {
        $this->bootstrap();
    }

    public function bootstrap()
    {
        $this->config = new Config();

        $this->toolkitSettings = [
            'stateless' => $this->config->getToolkitOption('stateless'),
            'plugSize' => $this->config->getToolkitOption('plugSize'),
            'debug' => $this->config->getToolkitOption('debug'),
            'debugLogFile' => $this->config->getToolkitOption('debugLogFile'),
            'InternalKey' => $this->config->getToolkitOption('InternalKey'),
        ];

        $this->namingMode = $this->config->getDb2Option('i5_naming');
        $db_options = [
            'i5_naming' => $this->config->getDb2Option('i5_naming'),
            'i5_libl' => $this->config->getDb2Option('i5_libl'),
        ];

        try {
            if ($this->config->getOption('use_persistent_db_connection'))
            {
                $this->dbConn = db2_pconnect(
                    $this->config->getDb2ConnectionOption('database'),
                    $this->config->getDb2ConnectionOption('user'),
                    $this->config->getDb2ConnectionOption('password'),
                    $db_options
                );
            } else {
                $this->dbConn = db2_connect(
                    $this->config->getDb2ConnectionOption('database'),
                    $this->config->getDb2ConnectionOption('user'),
                    $this->config->getDb2ConnectionOption('password'),
                    $db_options
                );
            }

        } catch (Exception $e) {
            throw new Exception('Error connecting. '.db2_stmt_error() . ' - ' . db2_stmt_errormsg());
        }
    }


    /**
     * @param ToolkitVersion $version
     * @param ToolkitSource $source
     * @param TransportType $transportType
     * @throws Exception
     */
    public function getToolkit(ToolkitVersion $version, ToolkitSource $source, TransportType $transportType)
    {
        $this->toolkitVersion = $version;
        $this->toolkitSource = $source;
        $this->transportType = $transportType;

        if ($version->getVersion() === 'dev' && $source->getSource() === 'composer') {
            $this->toolkitObject = new Toolkit($this->dbConn, $this->namingMode, null, $transportType->getTransportType());
        }

        if ($version->getVersion() === 'dev' && $source->getSource() !== 'composer') {
            $path = "/www/zendsvr6/htdocs/ToolkitTester/vendor/zendtech/IbmiToolkit/ToolkitApi/".$source->getSource();
            if (!file_exists($path))
            {
                throw new Exception('File '.$path.' doesn\'nt exist');
            }
            require_once $path;

            if ($transportType->isHttp() || $transportType->isHttps())
            {
                $this->toolkitObject = ToolkitService::getInstance('*LOCAL', $this->config->getDb2ConnectionOption('user'), $this->config->getDb2ConnectionOption('password'), $transportType->getTransportType());
            } else {
                $this->toolkitObject = ToolkitService::getInstance($this->dbConn, $this->namingMode, null, $transportType->getTransportType());
            }

        }

        if ($version->getVersion() === '1.6.0')
        {
            $path = "/www/zendsvr6/htdocs/ToolkitTester/vendor/zendtech/IbmiToolkit-1.6.0/ToolkitApi/".$source->getSource();
            if (!file_exists($path))
            {
                throw new Exception('File '.$path.' doesn\'nt exist');
            }
            require_once $path;
            $this->toolkitObject = ToolkitService::getInstance($this->dbConn, $this->namingMode, null, $transportType->getTransportType());
        }

        if ($version->getVersion() === 'old')
        {
            // Add toolkit to global include path
            $new_include_path = get_include_path().':/usr/local/zendsvr6/share/ToolkitApi';
            set_include_path($new_include_path);

            require_once($source->getSource());
            $this->toolkitObject = ToolkitService::getInstance($this->dbConn, $this->namingMode, null, $transportType->getTransportType());
        }

        $this->toolkitObject->setOptions($this->toolkitSettings);

        return;
    }

    public function callRpgProgram()
    {
        if ($this->transportType->isHttp() || $this->transportType->isHttps())
        {
            $result = $this->toolkitObject->CLCommand('CHGLIBL LIBL(ACSTEST)');
            if (!$result)
            {
                throw new Exception('An error occurred while trying to set the library list');
            }
        }

        // This number can be anything
        $number = 123456789;

        $param[] = $this->toolkitObject->AddParameterPackDec('both', 9,0, 'numIn', 'numIn', $number);
        $param[] = $this->toolkitObject->AddParameterPackDec('o', 9, 0, 'numOut', 'numOut', 0);
        $result = $this->toolkitObject->pgmCall("GETNUMBER", "ACSTEST", $param, null, null);

        if($result){
            $out = $result['io_param'];

            if ($number != $out['numOut'])
            {
                throw new Exception('<span class="failure"> - Call RPG program failed test</span>');
            }
        } else {
            throw new Exception('<span class="failure"> - Call RPG program failed test</span>');
        }

        echo '<span class="success"> + Call RPG Program test passed.</span>';
    }

    public function callClProgram()
    {

    }

    public function testHttpsTransport()
    {

    }

    public function testHttpTransport()
    {

    }

    public function testOdbcTransport()
    {

    }

    public function testCompatibilityWrapper()
    {

    }

    public function runAllTests()
    {
        $this->callRpgProgram();
        $this->callClProgram();
        $this->testHttpsTransport();
        $this->testHttpTransport();
        $this->testOdbcTransport();
        $this->testCompatibilityWrapper();
    }

}

/*
 * API to preserve:
 *
 * Users require ToolkitService.php and iToolkitService.php
 *
 * Users will also instantiate some objects after including iToolkitService.php
 * new UserSpace()
 * new DataArea()
 */