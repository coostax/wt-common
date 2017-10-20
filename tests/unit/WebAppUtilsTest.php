<?php


class WebAppUtilsTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests

    public function testCompressParams()
    {
      $params = array( 'param1' => 'value1', 'param2' => 2, 'param3' => true, 'key' => '$&(#%)');
      $compressed_1 = \Fccn\Lib\WebAppUtils::compress_params($params);
      $this->assertFalse(empty($compressed_1));
      $this->assertTrue(is_string($compressed_1));
      $params = array( 'param1' => 'value1', 'param2' => 2, 'param3' => true, 'key' => '$&(#%&)');
      $compressed_2 = \Fccn\Lib\WebAppUtils::compress_params($params);
      $this->assertFalse(empty($compressed_2));
      $this->assertTrue(is_string($compressed_2));
      $this->assertFalse($compressed_1 == $compressed_2);
    }

    public function testParamCompressDecompress()
    {
      $params = array( 'param1' => 'value1', 'param2' => 2, 'param3' => true);
      $compressed = \Fccn\Lib\WebAppUtils::compress_params($params);
      $this->assertFalse(empty($compressed));
      $this->assertTrue(is_string($compressed));
      $decompressed = \Fccn\Lib\WebAppUtils::decompress_params($compressed);
      $this->assertFalse(empty($decompressed));
      $this->assertTrue(is_object($decompressed));
      $this->assertTrue($decompressed->param1 == $params['param1']);
      $this->assertTrue($decompressed->param2 == $params['param2']);
      $this->assertTrue($decompressed->param3 == $params['param3']);
    }

    public function testGeneratePin()
    {
        $pin1 = \Fccn\Lib\WebAppUtils::generate_pin(10);
        $this->assertTrue(is_string($pin1));
        $this->assertTrue(strlen($pin1) == 10);
        $pin2 = \Fccn\Lib\WebAppUtils::generate_pin(10);
        $this->assertTrue(is_string($pin2));
        $this->assertTrue(strlen($pin2) == 10);
        $this->assertFalse($pin1 == $pin2);
    }


    public function testGenerateRandFor()
    {
        $text = "Hello World";
        $rand1 = \Fccn\Lib\WebAppUtils::generate_rand_for($text,10);
        $this->assertTrue(is_string($rand1));
        $this->assertTrue(strlen($rand1) == 10);
        $rand2 = \Fccn\Lib\WebAppUtils::generate_rand_for($text,10);
        $this->assertTrue(is_string($rand2));
        $this->assertTrue(strlen($rand2) == 10);
        $this->assertFalse($rand1 == $rand2);
    }

    public function testBytesPreetyPrint(){
      $bytes = 1024;
      $pprint = \Fccn\Lib\WebAppUtils::bytes_pretty_print($bytes);
      $this->assertTrue(is_string($pprint));
      $this->assertTrue($pprint == "1 KB");
      $bytes = 1024 * 1024;
      $pprint = \Fccn\Lib\WebAppUtils::bytes_pretty_print($bytes);
      $this->assertTrue(is_string($pprint));
      $this->assertTrue($pprint == "1 MB");
    }
}
