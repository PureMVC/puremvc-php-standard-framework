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
use puremvc\php\patterns\command\SimpleCommand;
use puremvc\php\patterns\observer\Notification;

require_once 'SimpleCommandTestCommand.php';
require_once 'SimpleCommandTestVO.php';

/**
 * Test the PureMVC SimpleCommand class.
 *
 * @see org.puremvc.php.patterns.command.SimpleCommandTestVO SimpleCommandTestVO
 * @see org.puremvc.php.patterns.command.SimpleCommandTestCommand SimpleCommandTestCommand
 */
class SimpleCommandTest extends \PHPUnit\Framework\TestCase
{	
	/**
	 * @var SimpleCommand
	 */
	private $SimpleCommand;
	
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
	 * Tests the <code>execute</code> method of a <code>SimpleCommand</code>.
  	 * 
  	 * <P>
  	 * This test creates a new <code>Notification</code>, adding a 
  	 * <code>SimpleCommandTestVO</code> as the body. 
  	 * It then creates a <code>SimpleCommandTestCommand</code> and invokes
  	 * its <code>execute</code> method, passing in the note.</P>
  	 * 
  	 * <P>
  	 * Success is determined by evaluating a property on the 
  	 * object that was passed on the Notification body, which will
  	 * be modified by the SimpleCommand</P>.
	 */
	public function testExecute()
	{
		// Create the VO
  		$vo = new SimpleCommandTestVO( 5 );
  		
  		// Create the Notification (note)
  		$note = new Notification( 'SimpleCommandTestNote', $vo );

		// Create the SimpleCommand  			
		$command = new SimpleCommandTestCommand();
   		
   		// Execute the SimpleCommand
   		$command->execute( $note );
   		
   		// test assertions
   		$this->assertTrue( $vo->result == 10, 'Expecting vo.result == 10');
	}
}

