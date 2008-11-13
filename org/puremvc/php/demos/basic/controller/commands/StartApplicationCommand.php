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

require_once 'org/puremvc/php/patterns/command/MacroCommand.php'; 
require_once 'org/puremvc/php/demos/basic/controller/commands/StartModelCommand.php'; 
require_once 'org/puremvc/php/demos/basic/controller/commands/StartViewCommand.php'; 

/**
 * The <code>StartApplicationCommand</code> prepares the view first 
 * so that it is ready to display data when the model is done loading.
 */
class StartApplicationCommand extends MacroCommand
{
	/**
	 * The <code>initializeMacroCommand</code> is overridden to
	 * add references to instances of SimpleCommand that should
	 * be executed.
	 */
	protected function initializeMacroCommand()
	{
		$this->addSubCommand( 'StartViewCommand' );
		$this->addSubCommand( 'StartModelCommand' );
	}
}

?>
