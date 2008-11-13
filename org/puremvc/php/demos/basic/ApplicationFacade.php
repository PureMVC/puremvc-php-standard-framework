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
require_once 'org/puremvc/php/patterns/facade/Facade.php';

// demo requires
require_once 'org/puremvc/php/demos/basic/controller/commands/StartApplicationCommand.php';

/**
 * ApplicationFacade for the BasicDemo starts the Model, View
 * Controller for the application.
 */
class ApplicationFacade extends Facade
{
	/**
	 * Notification constant that starts the application.
	 */
	const START_APPLICATION			= "startApplication";
	/**
	 * Notification constant sent when view data is ready to be displayed.
	 */
	const VIEW_DATA_READY			= "viewDataReady";
	
	/**
	 * Instance getter for the ApplicationFacade, this method
	 * starts the Facade.
	 */
	static public function getInstance()
	{
		if (parent::$instance == null)
		{
			parent::$instance = new ApplicationFacade();
		}
		
		return parent::$instance;
	}
	
	/**
	 * Starts the application by sending a START_APPLICATION notification.
	 * The filename (/index.php) is sent along to demonstrate passing
	 * data along.
	 */
	public function startUp( $filename, $cssName )
	{
		$this->sendNotification( ApplicationFacade::START_APPLICATION, $filename, $cssName );
	}
	
	/**
	 * Initializes the controller and gives you an opportunity to register application
	 * specific commands that extend SimpleCommand or MacroCommand with the PureMVC framework.
	 */
	protected function initializeController()
	{
		parent::initializeController();
		$this->registerCommand( ApplicationFacade::START_APPLICATION, 'StartApplicationCommand' );
	}
}

?>