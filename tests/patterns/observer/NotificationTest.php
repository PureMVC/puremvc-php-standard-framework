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
use puremvc\php\patterns\observer\Notification;

/**
 * Test the PureMVC Notification class.
 * 
 * @see org.puremvc.php.patterns.observer.Notification Notification
 */
class NotificationTest extends \PHPUnit\Framework\TestCase
{
	/**
	 * @var Notification
	 */
	private $Notification;
	
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
	 * Tests setting and getting the name using Notification class accessor methods.
	 */
	public function testNameAccessors()
	{
		// Create a new Notification and use accessors to set the note name 
   		$note = new Notification( 'TestNote' );
   		
   		// test assertions
   		$this->assertTrue( $note->getName() == 'TestNote', "Expecting note.getName() == 'TestNote'" );
	}
	
	/**
	 * Tests setting and getting the body using Notification class accessor methods.
	 */
	public function testBodyAccessors()
	{
		// Create a new Notification and use accessors to set the body
   		$note = new Notification( '' );
   		$note->setBody( 5 );
   		
   		// test assertions
   		$this->assertTrue( $note->getBody() == 5, "Expecting note.getBody() as Number == 5" );
	}
	
	/**
	 * Tests setting the name and body using the Notification class Constructor.
	 */
	public function testConstructor()
	{
		// Create a new Notification using the Constructor to set the note name and body
   		$note = new Notification( 'TestNote', 5, 'TestNoteType' );
   		
   		// test assertions
   		$this->assertTrue( $note->getName() == 'TestNote', "Expecting note.getName() == 'TestNote'" );
   		$this->assertTrue( $note->getBody() == 5, "Expecting note->getBody() as Number == 5" );
   		$this->assertTrue( $note->getType() == 'TestNoteType', "Expecting note->getType() == 'TestNoteType'" );
	}
	
	/**
	 * Tests the toString method of the notification
	 */
	public function testToString()
	{
		// Create a new Notification and use accessors to set the note name 
   		$note = new Notification( 'TestNote', array(1, 3, 5), 'TestType' );
   		$ts = "Notification Name: TestNote\nBody:Array\nType:TestType";
   		
   		// test assertions
   		$this->assertTrue( $note->toString() == $ts, "Expecting note->testToString() == $ts" );
	}
}

