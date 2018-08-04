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
use puremvc\php\patterns\command;
use puremvc\php\patterns\observer\Notification;

require_once 'MacroCommandTestCommand.php';
require_once 'MacroCommandTestVO.php';
/**
 * Test the PureMVC MacroCommand class.
 *
 * @see org.puremvc.php.patterns.command.MacroCommandTestVO MacroCommandTestVO
 * @see org.puremvc.php.patterns.command.MacroCommandTestCommand MacroCommandTestCommand
 */
class MacroCommandTest extends \PHPUnit\Framework\TestCase
{
	/**
	 * @var MacroCommand
	 */
	private $MacroCommand;
	
	/**
	 * Prepares the environment before running a test.
	 */
	protected function setUp()
	{
		parent::setUp();
	}
	
	/**
	 * Cleans up the environment after running a test.
	 */
	protected function tearDown()
	{
		parent::tearDown();
	}	

	/**
	 * Tests operation of a <code>MacroCommand</code>.
  	 * 
  	 * <P>
  	 * This test creates a new <code>Notification</code>, adding a 
  	 * <code>MacroCommandTestVO</code> as the body. 
  	 * It then creates a <code>MacroCommandTestCommand</code> and invokes
  	 * its <code>execute</code> method, passing in the 
  	 * <code>Notification</code>.<P>
  	 * 
  	 * <P>
  	 * The <code>MacroCommandTestCommand</code> has defined an
  	 * <code>initializeMacroCommand</code> method, which is 
  	 * called automatically by its constructor. In this method
  	 * the <code>MacroCommandTestCommand</code> adds 2 SubCommands
  	 * to itself, <code>MacroCommandTestSub1Command</code> and
  	 * <code>MacroCommandTestSub2Command</code>.
  	 * 
  	 * <P>
  	 * The <code>MacroCommandTestVO</code> has 2 result properties,
  	 * one is set by <code>MacroCommandTestSub1Command</code> by
  	 * multiplying the input property by 2, and the other is set
  	 * by <code>MacroCommandTestSub2Command</code> by multiplying
  	 * the input property by itself. 
  	 * 
  	 * <P>
  	 * Success is determined by evaluating the 2 result properties
  	 * on the <code>MacroCommandTestVO</code> that was passed to 
  	 * the <code>MacroCommandTestCommand</code> on the Notification 
  	 * body.</P>
	 */
	public function testMacroCommandExecute()
	{
		// Create the VO
  		$vo = new MacroCommandTestVO( 5 );
  		
  		// Create the Notification (note)
  		$note = new Notification( 'MacroCommandTest', $vo );
  		
		// Create the SimpleCommand  			
		$command = new MacroCommandTestCommand();
   		
   		// Execute the SimpleCommand
   		$command->execute( $note );
   		
   		// test assertions
   		$this->assertTrue( $vo->result1 == 10, "Expecting vo->result1 == 10" );
   		$this->assertTrue( $vo->result2 == 25, "Expecting vo->result2 == 25" );
	}
}

