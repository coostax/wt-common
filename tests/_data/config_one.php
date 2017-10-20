<?php
/*
* sub config file
*/

//test with array merge
$c = array_merge($c,array(
  "install_path"    => $fs_root,
  "base_path"       => "",
  "assets_path"     => "/assets",
));

//test with direct access to index
$c['logfile_path'] = __DIR__."/logs/test.log";
$c['logfile_level'] = "DEBUG";
