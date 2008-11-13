<?php
/**
 * PureMVC PHP Basic Demo
 * @author Omar Gonzalez :: omar@almerblank.com
 * @author Hasan Otuome :: hasan@almerblank.com 
 * 
 * Created on Sep 24, 2008
 * PureMVC - Copyright(c) 2006-2008 Futurescale, Inc., Some rights reserved.
 * Your reuse is governed by the Creative Commons Attribution 3.0 Unported License
 */

require_once 'org/puremvc/php/patterns/command/SimpleCommand.php';  
require_once 'org/puremvc/php/interfaces/INotification.php';
require_once 'org/puremvc/php/demos/basic/view/ApplicationMediator.php';  
require_once 'org/puremvc/php/demos/basic/view/ApplicationView.php'; 
 

/**
 * Starts the view class which initializes php/html templates.
 */
class StartViewCommand extends SimpleCommand
{
	/**
	 * The <code>execute()</code> method is overridden in order
	 * to add your application logic for this specific command.
	 */
	public function execute( INotification $notification )
	{
		$view = $notification->getBody();
		$this->facade->registerMediator( new ApplicationMediator( new ApplicationView( $view ) ) );
	}
}
?>
