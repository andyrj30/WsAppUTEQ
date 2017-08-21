<?php

/**
 * App Initializing File
 *
 *
 * @package Simple Framework
 * @author  Ahmed Saad <a7mad.sa3d.2014@gmail.com>
 * @license https://creativecommons.org/licenses/by-sa/4.0/legalcode.txt CC-BY-SA-4.0 Creative Commons Attribution Share Alike 4.0
 *
 */
// Define App Directories
defined('ROOT') ?: define('ROOT', dirname(dirname(__DIR__)));

defined('DS') ?: define('DS', DIRECTORY_SEPARATOR);
defined('APP') ?: define('APP', ROOT . DS . 'App');
defined('LIB') ?: define('LIB', APP . DS . 'Library');
defined('CONT') ?: define('CONT', APP . DS . 'Controllers');
defined('MODEL') ?: define('MODEL', APP . DS . 'Model');
defined('VIEW') ?: define('VIEW', APP . DS . 'View');
defined('CONF') ?: define('CONF', APP . DS . 'Config');
defined('ASSETS') ?: define('ASSETS', ROOT . DS . 'assets');

$database = require( CONF . DS . 'database.php' );

defined('DB_HOSTNAME1') ?: define('DB_HOSTNAME1', $database['db1_hostname']);
defined('DB_NAME1') ?: define('DB_NAME1', $database['db1_name']);
defined('DB_USERNAME1') ?: define('DB_USERNAME1', $database['db1_username']);
defined('DB_USERPWD1') ?: define('DB_USERPWD1', $database['db1_password']);
defined('DB_HOSTNAME2') ?: define('DB_HOSTNAME2', $database['db2_hostname']);
defined('DB_NAME2') ?: define('DB_NAME2', $database['db2_name']);
defined('DB_USERNAME2') ?: define('DB_USERNAME2', $database['db2_username']);
defined('DB_USERPWD2') ?: define('DB_USERPWD2', $database['db2_password']);

// Register Autoloader
function laoderFunc($class_name) {
    // echo '<br />' . $class_name . '<br />';
    $parts = explode('\\', $class_name);

    array_walk($parts, function( $v ) {
        return ucfirst($v);
    });

    $path = ROOT . DS . join($parts, DS) . '.php';

    if (file_exists($path))
        require( $path );
}

;

spl_autoload_register('laoderFunc');

// Open Database Connection
App\Library\DatabaseObjectTrait::openConnection();

require_once LIB . '/simple_html_dom.php';
// Start Session
new App\Library\Session();
