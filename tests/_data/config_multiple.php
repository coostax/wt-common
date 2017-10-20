<?php
/*
* loader of other config files
*/

#declare common variables
$fs_root = "/var/www";
$full_url = "http://localhost";

#create array
$c = array();

//load remaining files
require_once(__DIR__."/config_one.php");
