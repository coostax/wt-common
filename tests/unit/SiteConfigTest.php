<?php

namespace Fccn\Tests;

#require __DIR__ . '/../../vendor/autoload.php';

define("CONFIG_FILE", dirname(__FILE__) . DIRECTORY_SEPARATOR . "../_data/config_multiple.php");

class SiteConfigTest extends \Codeception\Test\Unit
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
    public function testLoadMultipleConfigFile()
    {
      #define("CONFIG_FILE", dirname(__FILE__) . DIRECTORY_SEPARATOR . "../_data/config_multiple.php");
      #$config = \Fccn\Lib\SiteConfig::getInstance();
      $this->assertFalse(empty($this->config));
      $this->assertFalse(empty($this->config->get('install_path')));
      $this->assertTrue($this->config->get('install_path') == '/var/www');
      $this->assertFalse(empty($this->config->get('logfile_path')));
    }

    public function testAddConfig()
    {
      $this->assertFalse(empty($this->config));
      $this->config->set('test','random');
      $this->assertFalse(empty($this->config->get('test')));
      $this->assertTrue($this->config->get('test') == 'random');
    }

    public function testGetAll(){
      $all = $this->config->all();
      $this->assertFalse(empty($all));
      $this->assertTrue(isset($all['install_path']));
      $this->assertTrue($all['install_path'] == '/var/www');
      $this->assertTrue(isset($all['logfile_path']));
    }

    #TODO test when key does not exist...
}
