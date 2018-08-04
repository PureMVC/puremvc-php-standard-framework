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
use puremvc\php\core\Controller;
use puremvc\php\interfaces\IController;
use puremvc\php\patterns\observer\Notification;

require_once 'ControllerTestCommand.php';
require_once 'ControllerTestCommand2.php';
require_once 'ControllerTestVO.php';

/**
 * Test the PureMVC Controller class.
 * 
 * @see org.puremvc.php.core.controller.ControllerTestVO ControllerTestVO
 * @see org.puremvc.php.core.controller.ControllerTestCommand ControllerTestCommand
 */
class ControllerTest extends \PHPUnit\Framework\TestCase
{
	/**
	 * @var Controller
	 */
	private $Controller;
	
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
	 * Tests the Controller Singleton Factory Method 
	 */
	public function testGetInstance()
	{
		// Test Factory Method
   		$controller = Controller::getInstance();
   		
   		// test assertions
   		$this->assertTrue( $controller != null, "Expecting instance not null" );
   		$this->assertTrue( $controller instanceof IController, "Expecting instance implements IController" );
	}
	
	/**
	 * Tests Command registration and execution.
	 * 
	 * <P>
  	 * This test gets the Singleton Controller instance 
  	 * and registers the ControllerTestCommand class 
  	 * to handle 'ControllerTest' Notifications.<P>
  	 * 
  	 * <P>
  	 * It then constructs such a Notification and tells the 
  	 * Controller to execute the associated Command.
  	 * Success is determined by evaluating a property
  	 * on an object passed to the Command, which will
  	 * be modified when the Command executes.</P>
	 */
	public function testRegisterAndExecuteCommand()
	{
		// Create the controller, register the ControllerTestCommand to handle 'ControllerTest' notes
   		$controller = Controller::getInstance();
   		$controller->registerCommand( 'ControllerTest', new ControllerTestCommand() );
   		
   		// Create a 'ControllerTest' note
   		$vo = new ControllerTestVO( 12 );
   		$note = new Notification( 'ControllerTest', $vo );

		// Tell the controller to execute the Command associated with the note
		// the ControllerTestCommand invoked will multiply the vo.input value
		// by 2 and set the result on vo.result
   		$controller->executeCommand( $note );
   		
   		// test assertions 
   		$this->assertTrue( $vo->result == 24, "Expecting vo.result == 24" );
	}
	
	/**
	 * Tests Command registration and removal.
	 * 
	 * <P>
  	 * Tests that once a Command is registered and verified
  	 * working, it can be removed from the Controller.</P>
	 */
	public function testRegisterAndRemoveCommand()
	{
		// Create the controller, register the ControllerTestCommand to handle 'ControllerTest' notes
   		$controller = Controller::getInstance();
   		$controller->registerCommand( 'ControllerRemoveTest', new ControllerTestCommand() );
   		
   		// Create a 'ControllerTest' note
   		$vo = new ControllerTestVO( 12 );
   		$note = new Notification( 'ControllerRemoveTest', $vo );

		// Tell the controller to execute the Command associated with the note
		// the ControllerTestCommand invoked will multiply the vo.input value
		// by 2 and set the result on vo.result
   		$controller->executeCommand( $note );
   		
   		// test assertions 
   		$this->assertTrue( $vo->result == 24, "Expecting vo.result == 24" );
   		
   		// Reset result
   		$vo->result = 0;
   		
   		// Remove the Command from the Controller
   		$controller->removeCommand( 'ControllerRemoveTest' );
		
		// Tell the controller to execute the Command associated with the
		// note. This time, it should not be registered, and our vo result
		// will not change   			
   		$controller->executeCommand( $note );
   		
   		// test assertions 
   		$this->assertTrue( $vo->result == 0, "Expecting $vo->result == 0" );
	}
	
	/**
	 * Tests hasCommand method.
	 */
	public function testHasCommand()
	{
		// register the ControllerTestCommand to handle 'hasCommandTest' notes
   		$controller = Controller::getInstance();
   		$controller->registerCommand( 'hasCommandTest', new ControllerTestCommand() );
   		
   		// test that hasCommand returns true for hasCommandTest notifications 
   		$this->assertTrue( $controller->hasCommand('hasCommandTest') == true, "Expecting controller->hasCommand('hasCommandTest') == true" );
   		
   		// Remove the Command from the Controller
   		$controller->removeCommand( 'hasCommandTest' );
		
   		// test that hasCommand returns false for hasCommandTest notifications 
   		$this->assertTrue( $controller->hasCommand('hasCommandTest') == false, "Expecting controller->hasCommand('hasCommandTest') == false" );
	}

}

