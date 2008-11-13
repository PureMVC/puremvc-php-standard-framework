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
define( 'PMVC_BASE_DIR', dirname( __FILE__ ) );

/**
 * Checks all paths defined in $_includePaths for 
 * the existence of $class and loads $class if found.
 * 
 * @param string $class The class to search for.
 */
function __autoload( $class )
{
	$_includePaths = array(
							PMVC_BASE_DIR . '/org/puremvc/php/core', 
							PMVC_BASE_DIR . '/org/puremvc/php/interfaces', 
							PMVC_BASE_DIR . '/org/puremvc/php/patterns', 
							PMVC_BASE_DIR . '/org/puremvc/php/patterns/command', 
							PMVC_BASE_DIR . '/org/puremvc/php/patterns/facade', 
							PMVC_BASE_DIR . '/org/puremvc/php/patterns/mediator', 
							PMVC_BASE_DIR . '/org/puremvc/php/patterns/observer', 
							PMVC_BASE_DIR . '/org/puremvc/php/patterns/proxy',							
							);

	$classPath = get_include_path();
	$classPathTokens = explode( ':', $classPath );

	$classXtn = '.php';

	foreach ($classPathTokens as $prefix)
	{
		foreach ($_includePaths as $includePath)
		{
			$path = "$includePath/$class$classXtn";
			if (file_exists($path)) 
			{
				require_once $path;
				return;
			}
		}
	}
}	

?>