<?php
/**
 * PureMVC PHP Class Autoloader
 * @author Omar Gonzalez :: omar@almerblank.com
 * @author Hasan Otuome :: hasan@almerblank.com 
 *
 * Class auto-loader for use with the PureMVC Port for PHP. 
 * 
 * While it's usage is completely optional, usage will reduce 
 * the amount of require(), require_once(), include() and include_once() 
 * statements you would need to write.
 *
 * It also provides the benefit of allowing you to centralize the location of 
 * your PureMVC framework to just one location.
 * 
 * USAGE:
 * 1) Change the paths listed in the $_includePaths array to match your PureMVC PHP install paths.
 * 2) Add a require_once() statement to your index or bootstrap PHP file.
 * 		ie., require_once 'path/to/puremvc_autoloader.php';
 */

/**
 * Defines a constant that indicates that the base directory ("root") for lookups should be 
 * the directory in which this file is located in.
 */
//define( 'PMVC_BASE_DIR', __DIR__ );

/**
 * Checks all paths defined in $_includePaths for 
 * the existence of $class and loads $class if found.
 * 
 * @param string $class The class to search for.
 */


/**
 * @see http://www.php-fig.org/psr/psr-4/examples/
 */
spl_autoload_register(function ($class) {
    // project-specific namespace prefix
    $prefix = 'puremvc\php\\';

    // base directory for the namespace prefix
    $base_dir = __DIR__ . '/org/puremvc/php/';

    // does the class use the namespace prefix?
    $len      = strlen($prefix);

    if (0 !== strncmp($prefix, $class, $len)) {
        return;
    }

    // get the relative class name
    $relativeClass = substr($class, $len);

    // replace the namespace prefix with the base directory, replace namespace
    // separators with directory separators in the relative class name, append
    // with .php
    $file           = $base_dir . str_replace('\\', '/', $relativeClass) . '.php';

    // if the file exists, require it
    if (file_exists($file)) {
        require $file;
    }
});
