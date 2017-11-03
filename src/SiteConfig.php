<?php
/*
* Configuration singleton, loads a configuration from a file in a location defined by the
* CONFIG_FILE variable. If not set defaults to config.php on the project's root
*/

namespace Fccn\Lib;

class SiteConfig
{
    private $configs;
    private static $instance;

    public function __construct($array = null)
    {
        $this->configs = $array;
    }

    public static function getInstance()
    {
        if (!SiteConfig::$instance instanceof self) {
            if (!defined('CONFIG_FILE')) {
                define("CONFIG_FILE", __DIR__ . "/../config.php");
            }

            //Load configuration file
            include CONFIG_FILE;

            SiteConfig::$instance = new self($c);
        }

        return SiteConfig::$instance;
    }


    public function set($key, $value)
    {
        $this->configs[$key] = $value;
    }

    public function get($key)
    {
        if (!isset($this->configs[$key])) {
            throw new \Exception("Unknown config variable ['$key']");
        }

        return $this->configs[$key];
    }

    public function dump()
    {
        return var_export($this->configs);
    }

    public function all()
    {
        return $this->configs;
    }
}
