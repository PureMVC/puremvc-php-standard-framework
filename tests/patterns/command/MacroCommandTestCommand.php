<?php
/**
 * PureMVC PHP Unit Tests
 * @author Omar Gonzalez :: omar@almerblank.com
 * @author Hasan Otuome :: hasan@almerblank.com 
 * 
 * Created on Sep 24, 2008
 * PureMVC - Copyright(c) 2006-2008 Futurescale, Inc., Some rights reserved.
 * Your reuse is governed by the Creative Commons Attribution 3.0 Unported License
 */
use puremvc\php\patterns\command\MacroCommand;

require_once 'MacroCommandTestSub1Command.php';
require_once 'MacroCommandTestSub2Command.php';
/**
 * A MacroCommand subclass used by MacroCommandTest.
 *
 * @see org.puremvc.php.patterns.command.MacroCommandTest MacroCommandTest
 * @see org.puremvc.php.patterns.command.MacroCommandTestSub1Command MacroCommandTestSub1Command
 * @see org.puremvc.php.patterns.command.MacroCommandTestSub2Command MacroCommandTestSub2Command
 * @see org.puremvc.php.patterns.command.MacroCommandTestVO MacroCommandTestVO
 */
class MacroCommandTestCommand extends MacroCommand
{	
	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
	}
	/**
	 * Initialize the MacroCommandTestCommand by adding
	 * its 2 SubCommands.
	 */
	public function initializeMacroCommand()
	{
		$this->addSubCommand( new MacroCommandTestSub1Command() );
		$this->addSubCommand( new MacroCommandTestSub2Command() );
	}
}

?>
