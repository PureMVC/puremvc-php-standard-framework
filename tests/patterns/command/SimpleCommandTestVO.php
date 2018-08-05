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
 * A utility class used by SimpleCommandTest.
 * 
 * @see org.puremvc.php.patterns.command.SimpleCommandTest SimpleCommandTest
 * @see org.puremvc.php.patterns.command.SimpleCommandTestCommand SimpleCommandTestCommand
 */
class SimpleCommandTestVO
{	
	public $input;
	public $result;
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
