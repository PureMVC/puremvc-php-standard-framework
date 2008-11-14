<?php
/**
 * PureMVC PHP Basic Demo
 * PureMVC Port to PHP originally translated by Asbjørn Sloth Tønnesen
 *
 * @author Omar Gonzalez :: omar@almerblank.com
 * @author Hasan Otuome :: hasan@almerblank.com 
 * 
 * Created on Sep 24, 2008
 * PureMVC - Copyright(c) 2006-2008 Futurescale, Inc., Some rights reserved.
 * Your reuse is governed by the Creative Commons Attribution 3.0 Unported License
 */

require_once 'org/puremvc/php/demos/basic/BasicDemo.php';

// name of file user browsed to
$filename = $_SERVER[ 'PHP_SELF' ];

// css file name from css zen garden styles click
if (isset( $_GET[ 'c' ] ))
{
	$cssName = $_GET[ 'c' ];
}
else
{
	$cssName = "default";
}

function html_debug( $stack )
{
	print( $stack . '<br/>' );
}

// start php application
$basicDemo = new BasicDemo();
// start up the view by sending in the variables.
$basicDemo->startView( $filename, $cssName );
?>
