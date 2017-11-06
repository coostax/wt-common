# Webapp tools - Common tools collection

This collection provides common utilities for the webapp skeleton project, such as site configuration singleton loader a singleton file logger and a collection of utility functions for generating content.

## Installation

You can install this collection in your project using composer
```
composer require fccn/webapp-tools-common

```

## Collection components

The following components are part of this collection.

### Site configuration loader

This is a singleton class that provides a centralized location for the application configuration. The configuration is loaded from a single PHP file, containing an array with all configuration options. It is also possible to use multiple configuration files as long as the main configuration file that is loaded by the configuration loader requires the remaining configuration files.

#### Configuration

The path to the configuration file can be defined in the *CONFIG_FILE* variable. Just add in your code ``define("CONFIG_FILE", <path-to-your-config>);`` before loading this collection. If the path to the configuration file is not set it defaults to config.php on the root folder.

An example of the possible content of the configuration file is shown below:

```php

$c = array(
  "install_path"    => $fs_root,
  "base_path"       => "",
  "assets_path"     => $fs_root."/assets",
  "logfile_path"    => $fs_root."/logs/test.log",
  "logfile_level"     => "DEBUG",
));

```

The configuration file needs to follow a set of directives in order for it to be correctly loaded in the configuration loader:
- the configuration settings must be in the form of key => value
- the settings must be defined inside an array named *$c*
- you can define other variables in the configuration but the configuration loader will only look for the key value pairs inside *$c*

A sample of a configuration file can be found in **samples/config_sample.php**. The

#### Usage

To access the configuration loader use ``\Fccn\Lib\SiteConfig::getInstance()``. To get the configuration value use the get() method, for example, to get the value for *logfile_path* use ``\Fccn\Lib\SiteConfig::getInstance()->get('logfile_path')``.

You can also add new configurations or replace a configuration on demand by using the set() method ``\Fccn\Lib\SiteConfig::getInstance()->set('key','value')``. However, these values are not permanently stored in the configuration file.

### File logger

The file logger is a configurable wrapper for Monolog. It provides a singleton class for writing debug, notice, info, warn and error messages. It uses the configuration loader to load the settings for the path to the logfile and the log level.

#### Configuration

The following key-value pairs need to be added to the application configuration file *$c* array:
```php
$c = array(
    ...
    "logfile_path"    => "path-to-log-file",
    "logfile_level"     => "DEBUG|ERROR|INFO|NOTICE|WARNING",
    ...
  )
```

#### Usage

To write a log line you can use the error(), warn(), info(), notice() and debug() methods. For example to write a warning log line use  ``\Fccn\Lib\FileLogger::warn('some warning')``.

To get the singleton instance of the file logger use ``\Fccn\Lib\FileLogger::getInstance()``

### Web application utilities

This presents a collection of utilities that are used by the webapp skeleton project. At this moment the following functions are available:
- compress_params - turns an array of parameters into a compressed string to use on GET requests
- decompress_params - retrieve the array of parameters from the compressed string from the method above

#### Configuration

No configuration is required to use the web application utilities

#### Usage
```php
//compress parameters to use on a GET request
\Fccn\Lib\WebAppUtils::compress_params('param1' => 'val1', 'param2' => 2)

//retrieve parameters from a GET parameter
\Fccn\Lib\WebAppUtils::decompress_params($_GET['params']);

```

## Testing

This project uses codeception for testing. To run the tests call ``composer test`` on the root of the project folder.

## Contributing

Please read [CONTRIBUTING.md](CONTRIBUTING.md) for details on our code of conduct, and the process for submitting pull requests to us.

## Versioning

We use [SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://github.com/fccn/wt-common/tags).

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details
