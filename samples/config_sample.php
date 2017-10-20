<?php
/*
* This is a sample configuration file to be used with the Fccn\Lib\SiteConfig singleton
*/

//common vars to be used on file
$fs_root = "/var/www";

//the configuration array - make sure it is called $c
$c = array(
  "install_path"    => $fs_root,
  "base_path"       => "",
  "assets_path"     => $fs_root."/assets",
  "logfile_path"    => $fs_root."/logs/test.log",
  "logfile_level"     => "DEBUG",
));
