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
/**
 * A utility class used by MacroCommandTest.
 * 
 * @see org.puremvc.php.patterns.command.MacroCommandTest MacroCommandTest
 * @see org.puremvc.php.patterns.command.MacroCommandTestCommand MacroCommandTestCommand
 * @see org.puremvc.php.patterns.command.MacroCommandTestSub1Command MacroCommandTestSub1Command
 * @see org.puremvc.php.patterns.command.MacroCommandTestSub2Command MacroCommandTestSub2Command
 */
class MacroCommandTestVO
{	
	public $input;
	public $result1;
	public $result2;
	/**
	 * Constructor
	 * 
	 * @param input the number to be fed to the SimpleCommandTestCommand.
	 */
	public function __construct( $testValue )
	{
		$this->input = $testValue;
	}
}

?>
