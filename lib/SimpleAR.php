<?php
namespace SimpleAR;

if (!defined('PHP_VERSION_ID') || PHP_VERSION_ID < 50300)
{
	die('SimpleAR requires PHP 5.3 or higher.');
}

define('PHP_SIMPLEAR_VERSION_ID', '1.0');

require 'Config.php';
require 'Database.php';
require 'Table.php';
require 'Query.php';
require 'Model.php';
require 'Relationship.php';
require 'exceptions/Exception.php';
require 'exceptions/DatabaseException.php';
require 'exceptions/DuplicateKeyException.php';
require 'exceptions/RecordNotFoundException.php';

spl_autoload_register(function($sClass) {
    if (file_exists($sFile = Config::instance()->modelDirectory . $sClass . '.php'))
    {
        include $sFile;

        /**
         * Loaded class might not be a subclass of Model. It can just be a
         * independant model class located in same directory and loaded by this
         * autoload function.
         */
		if (is_subclass_of($sClass, 'SimpleAR\Model'))
		{
        	$sClass::init();
		}
    }
});
