<?php

namespace Fccn\Tests;

define("CONFIG_FILE", dirname(__FILE__) . DIRECTORY_SEPARATOR . "../_data/config_multiple.php");

class FileLoggerTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    private $config;

    protected function _before()
    {
      $this->config = \Fccn\Lib\SiteConfig::getInstance();
    }

    protected function _after()
    {
    }

    // tests
    public function testConfigSettings()
    {
      $this->assertFalse(empty(\Fccn\Lib\SiteConfig::getInstance()->get('logfile_path')));
      $this->assertFalse(empty(\Fccn\Lib\SiteConfig::getInstance()->get('logfile_level')));
    }

    public function testGetInstance()
    {
      $logger = \Fccn\Lib\FileLogger::getInstance();
      $this->assertFalse(empty($logger));
    }

    public function testWriteDebug()
    {
      $logger = \Fccn\Lib\FileLogger::getInstance();
      $logger->debug('This is a debug message');
      $this->assertFalse(empty($logger));
    }

    public function testpushProcessor(){
      $logger = \Fccn\Lib\FileLogger::getInstance();
      $logger->pushProcessor(new \Monolog\Processor\UidProcessor());
      $logger->debug('This is a debug message');
      $this->assertFalse(empty($logger));
    }

    public function testpushHandler(){
      $logger = \Fccn\Lib\FileLogger::getInstance();
      $logger->pushHandler(new \Monolog\Handler\StreamHandler(\Fccn\Lib\SiteConfig::getInstance()->get('logfile_path'), \Fccn\Lib\SiteConfig::getInstance()->get('logfile_level')));
      $logger->debug('This is a debug message');
      $this->assertFalse(empty($logger));
    }
}
