<?php
/*
* Singleton file logging utility.
*
* Requires the configuration settings for:
*  logfile_level
*  logfile_path
*/

namespace Fccn\Lib;

class FileLogger{

  private $logger;
  private static $instance;

  private function __construct() {
    $this->logger = new \Monolog\Logger('app_log');
    $log_lvl = '';
    switch (SiteConfig::getInstance()->get('logfile_level')) {
      case 'DEBUG':
        $log_lvl = \Monolog\Logger::DEBUG;
        break;
      case 'ERROR':
        $log_lvl = \Monolog\Logger::ERROR;
        break;
      case 'INFO':
        $log_lvl = \Monolog\Logger::INFO;
        break;
      case 'NOTICE':
        $log_lvl = \Monolog\Logger::NOTICE;
        break;
      default:
        $log_lvl = \Monolog\Logger::WARNING;
        break;
    }
    // config log format
    $dateFormat = "Y-m-d H:i:s";
    $output = "[%level_name%]::%datetime%: %message% %context% %extra%\n";
    //create a formatter
    $formatter = new \Monolog\Formatter\LineFormatter($output, $dateFormat);
    $stream = new \Monolog\Handler\StreamHandler(SiteConfig::getInstance()->get('logfile_path'), $log_lvl);
    $stream->setFormatter($formatter);
    $this->logger->pushHandler($stream);
  }

  public static function getInstance() {
  	if (!FileLogger::$instance instanceof self) {
  		FileLogger::$instance = new self();
  	}
  	return FileLogger::$instance;
  }

  public static function error($message){
    FileLogger::getInstance()->logger->error($message);
  }

  public static function warn($message){
    FileLogger::getInstance()->logger->warning($message);
  }

  public static function info($message){
    FileLogger::getInstance()->logger->info($message);
  }

  public static function notice($message){
    FileLogger::getInstance()->logger->notice($message);
  }

  public static function debug($message){
    FileLogger::getInstance()->logger->debug($message);
  }

  //redirects for Monolog functions

  public function pushProcessor($processor){
    $this->logger->pushProcessor($processor);
  }

  public function pushHandler($processor){
    $this->logger->pushHandler($processor);
  }

}
