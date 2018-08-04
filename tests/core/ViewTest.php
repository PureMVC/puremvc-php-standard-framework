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
use puremvc\php\core\View;
use puremvc\php\patterns\observer\Observer;
use puremvc\php\patterns\observer\Notification;
use puremvc\php\patterns\mediator\Mediator;
use puremvc\php\interfaces\INotification;
use puremvc\php\interfaces\IView;

require_once 'ViewTestNote.php';
require_once 'ViewTestMediator.php';
require_once 'ViewTestMediator2.php';
require_once 'ViewTestMediator3.php';
require_once 'ViewTestMediator4.php';
require_once 'ViewTestMediator5.php';
require_once 'ViewTestMediator6.php';
/**
 * Test the PureMVC View class.
 */
class ViewTest extends \PHPUnit\Framework\TestCase
{
	/**
	 * @var View
	 */
	private $View;
	
	/**
  	 * A test variable that proves the viewTestMethod was
  	 * invoked by the View.
  	 */
	private $viewTestVar;
	
 	const NOTE1 = "Notification1";
	const NOTE2 = "Notification2";
	const NOTE3 = "Notification3";
	const NOTE4 = "Notification4";
	const NOTE5 = "Notification5";
	const NOTE6 = "Notification6";
	
	public $lastNotification;	
  	public $onRegisterCalled = false;
  	public $onRemoveCalled = false;
  	public $counter = 0;
	
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
		parent::tearDown ();
	}

	/**
	 * Tests the View Singleton Factory Method 
	 */
	public function testGetInstance()
	{
		// Test Factory Method
   		$view = View::getInstance();
   		
   		// test assertions
   		$this->assertTrue( $view != null, "Expecting instance not null" );
   		$this->assertTrue( $view instanceof IView, "Expecting instance implements IView" );
	}
	
	/**
	 * Tests registration and notification of Observers.
  	 * 
  	 * <P>
  	 * An Observer is created to callback the viewTestMethod of
  	 * this ViewTest instance. This Observer is registered with
  	 * the View to be notified of 'ViewTestEvent' events. Such
  	 * an event is created, and a value set on its payload. Then
  	 * the View is told to notify interested observers of this
  	 * Event. 
  	 * 
  	 * <P>
  	 * The View calls the Observer's notifyObserver method
  	 * which calls the viewTestMethod on this instance
  	 * of the ViewTest class. The viewTestMethod method will set 
  	 * an instance variable to the value passed in on the Event
  	 * payload. We evaluate the instance variable to be sure
  	 * it is the same as that passed out as the payload of the 
  	 * original 'ViewTestEvent'.
	 */
	public function testRegisterAndNotifyObserver()
	{
		// Get the Singleton View instance
  		$view = View::getInstance();
  		
   		// Create observer, passing in notification method and context
   		$observer = new Observer( 'viewTestMethod', $this );
   		
   		// Register Observer's interest in a particulat Notification with the View 
   		$view->registerObserver( ViewTestNote::NAME, $observer);
  		
   		// Create a ViewTestNote, setting 
   		// a body value, and tell the View to notify 
   		// Observers. Since the Observer is this class 
   		// and the notification method is viewTestMethod,
   		// successful notification will result in our local 
   		// viewTestVar being set to the value we pass in 
   		// on the note body.
   		$note = ViewTestNote::create( 10 );
		$view->notifyObservers( $note );

		// test assertions  			
   		$this->assertTrue( $this->viewTestVar == 10, "Expecting viewTestVar = 10" );
	}
	
	/**
	 * Tests registering and retrieving a mediator with
	 * the View.
	 */
	public function testRegisterAndRetrieveMediator()
	{
		// Get the Singleton View instance
  		$view = View::getInstance();

		// Create and register the test mediator
		$viewTestMediator = new ViewTestMediator( $this );
		$view->registerMediator( $viewTestMediator );
		
		// Retrieve the component
		$mediator = $view->retrieveMediator( ViewTestMediator::NAME );
		
		// test assertions  			
   		$this->assertTrue( $mediator instanceof ViewTestMediator, "Expecting comp is ViewTestMediator" );
   		
   		$this->cleanup();
	}
	
	/**
  	 * Tests the hasMediator Method
  	 */
  	public function testHasMediator()
  	{
  		// register a Mediator
   		$view = View::getInstance();
		
		// Create and register the test mediator
		$mediator = new Mediator( 'hasMediatorTest', $this );
		$view->registerMediator( $mediator );
		
   		// assert that the view.hasMediator method returns true
   		// for that mediator name
   		$this->assertTrue( $view->hasMediator('hasMediatorTest') == true, 
   								"Expecting view.hasMediator('hasMediatorTest') == true" );

		$view->removeMediator( 'hasMediatorTest' );
		
   		// assert that the view.hasMediator method returns false
   		// for that mediator name
   		$this->assertTrue( $view->hasMediator('hasMediatorTest') == false, "Expecting view.hasMediator('hasMediatorTest') == false" );
   	}
	
   	
	/**
	 * Tests registering and removing a mediator 
	 */
	public function testRegisterAndRemoveMediator()
	{	
  		// Get the Singleton View instance
  		$view = View::getInstance();

		// Create and register the test mediator
		$mediator = new Mediator( 'testing', $this );
		$view->registerMediator( $mediator );
		
		// Remove the component
		$removedMediator = $view->removeMediator( 'testing' );
		
		// assert that we have removed the appropriate mediator
   		$this->assertTrue( $removedMediator->getMediatorName() == 'testing', "Expecting removedMediator.getMediatorName() == 'testing'" );
			
		// assert that the mediator is no longer retrievable
   		$this->assertTrue( $view->retrieveMediator('testing') == null, "Expecting view->retrieveMediator( 'testing' ) == null )" );
   					
		$this->cleanup();
	}
	
	/**
	 * Tests that the View calls the onRegister and onRemove methods
	 */
	public function testOnRegisterAndOnRemove()
	{
		// Get the Singleton View instance
  		$view = View::getInstance();

		// Create and register the test mediator
		$mediator = new ViewTestMediator4( $this );
		$view->registerMediator( $mediator );

		// assert that onRegsiter was called, and the mediator responded by setting our boolean
   		$this->assertTrue( $this->onRegisterCalled, "Expecting onRegisterCalled == true" );
		
		// Remove the component
		$view->removeMediator( ViewTestMediator4::NAME );
		
		// assert that the mediator is no longer retrievable
   		$this->assertTrue( $this->onRemoveCalled, "Expecting onRemoveCalled == true" );
   					
		$this->cleanup();
	}
	
	/**
	 * Tests successive regster and remove of same mediator.
	 */
	public function testSuccessiveRegisterAndRemoveMediator()
	{
		// Get the Singleton View instance
  		$view = View::getInstance();

		// Create and register the test mediator, 
		// but not so we have a reference to it
		$view->registerMediator( new ViewTestMediator( $this ) );
		
		// test that we can retrieve it
   		$this->assertTrue( $view->retrieveMediator( ViewTestMediator::NAME ) instanceof ViewTestMediator, 
   						"Expecting view->retrieveMediator( ViewTestMediator.NAME ) is ViewTestMediator" );

		// Remove the Mediator
		$view->removeMediator( ViewTestMediator::NAME );

		// test that retrieving it now returns null			
   		$this->assertTrue( $view->retrieveMediator( ViewTestMediator::NAME ) == null, 
   							"Expecting view->retrieveMediator( ViewTestMediator::NAME ) == null" );

		// test that removing the mediator again once its gone doesn't cause crash 		
   		$this->assertTrue( $view->removeMediator( ViewTestMediator::NAME ) == null, 
   							"Expecting view->removeMediator( ViewTestMediator::NAME ) doesn't crash" );

		// Create and register another instance of the test mediator, 
		$view->registerMediator( new ViewTestMediator( $this ) );
		
   		$this->assertTrue( $view->retrieveMediator( ViewTestMediator::NAME ) instanceof ViewTestMediator, 
   							"Expecting view->retrieveMediator( ViewTestMediator::NAME ) is ViewTestMediator" );

		// Remove the Mediator
		$view->removeMediator( ViewTestMediator::NAME );
		
		// test that retrieving it now returns null			
   		$this->assertTrue( $view->retrieveMediator( ViewTestMediator::NAME ) == null, 
   							"Expecting view->retrieveMediator( ViewTestMediator::NAME ) == null" );

		$this->cleanup();						  			
	}
	
	/**
	 * Tests registering a Mediator for 2 different notifications, removing the
	 * Mediator from the View, and seeing that neither notification causes the
	 * Mediator to be notified. Added for the fix deployed in version 1.7
	 */
	public function _testRemoveMediatorAndSubsequentNotify()
	{
		// Get the Singleton View instance
  		$view = View::getInstance();
		
		// Create and register the test mediator to be removed.
		$view->registerMediator( new ViewTestMediator2( $this ) );
		
		// test that notifications work
   		$view->notifyObservers( new Notification(ViewTest::NOTE1) );
   		print( '<br/>last note = ' . $this->lastNotification . '<br/>' );
   		$this->assertTrue( $this->lastNotification == ViewTest::NOTE1, 
   							"Expecting lastNotification == NOTE1" );
   		
   		$view->notifyObservers( new Notification(NOTE2) );
   		$this->assertTrue( $this->lastNotification == ViewTest::NOTE2, 
   							"Expecting lastNotification == NOTE2" );

		// Remove the Mediator
		$view->removeMediator( ViewTestMediator2::NAME );

		// test that retrieving it now returns null			
   		$this->assertTrue( $view->retrieveMediator( ViewTestMediator2::NAME ) == null, 
   							"Expecting view->retrieveMediator( ViewTestMediator2.NAME ) == null" );

		// test that notifications no longer work
		// (ViewTestMediator2 is the one that sets lastNotification
		// on this component, and ViewTestMediator)
		$this->lastNotification = null;
		
   		$view->notifyObservers( new Notification(ViewTest::NOTE1) );
   		$this->assertTrue( $this->lastNotification != ViewTest::NOTE1, 
   							"Expecting lastNotification != NOTE1" );

   		$view->notifyObservers( new Notification(ViewTest::NOTE2) );
   		$this->assertTrue( $this->lastNotification != ViewTest::NOTE2, 
   							"Expecting lastNotification != NOTE2" );

		$this->cleanup();						  			
	}
	
	/**
	 * Tests registering one of two registered Mediators and seeing
	 * that the remaining one still responds.
	 * Added for the fix deployed in version 1.7.1
	 */
	public function _testRemoveOneOfTwoMediatorsAndSubsequentNotify()
	{
		// Get the Singleton View instance
  		$view = View::getInstance();
		
		// Create and register that responds to notifications 1 and 2
		$view->registerMediator( new ViewTestMediator2( $this ) );
		
		// Create and register that responds to notification 3
		$view->registerMediator( new ViewTestMediator3( $this ) );
		
		// test that all notifications work
   		$view->notifyObservers( new Notification(ViewTest::NOTE1) );
   		$this->assertTrue( $this->lastNotification == ViewTest::NOTE1, 
   							"Expecting lastNotification == NOTE1" );

   		$view->notifyObservers( new Notification(ViewTest::NOTE2) );
   		$this->assertTrue( $this->lastNotification == ViewTest::NOTE2, 
   							"Expecting lastNotification == NOTE2" );

   		$view->notifyObservers( new Notification(ViewTest::NOTE3) );
   		$this->assertTrue( $this->lastNotification == ViewTest::NOTE3, 
   							"Expecting lastNotification == NOTE3" );
	   			
		// Remove the Mediator that responds to 1 and 2
		$view->removeMediator( ViewTestMediator2::NAME );

		// test that retrieving it now returns null			
   		$this->assertTrue( $view->retrieveMediator( ViewTestMediator2::NAME ) == null, 
   						"Expecting view->retrieveMediator( ViewTestMediator2.NAME ) == null" );

		// test that notifications no longer work
		// for notifications 1 and 2, but still work for 3
		$this->lastNotification = null;
		
   		$view->notifyObservers( new Notification(ViewTest::NOTE1) );
   		$this->assertTrue( $this->lastNotification != ViewTest::NOTE1, 
   							"Expecting lastNotification != NOTE1" );

   		$view->notifyObservers( new Notification(ViewTest::NOTE2) );
   		$this->assertTrue( $this->lastNotification != ViewTest::NOTE2, 
   							"Expecting lastNotification != NOTE2" );

   		$view->notifyObservers( new Notification(ViewTest::NOTE3) );
   		$this->assertTrue( $this->lastNotification == ViewTest::NOTE3, 
   							"Expecting lastNotification == NOTE3" );

		$this->cleanup();						  			
	}
	
	/**
	 * Tests registering the same mediator twice. 
	 * A subsequent notification should only illicit
	 * one response. Also, since reregistration
	 * was causing 2 observers to be created, ensure
	 * that after removal of the mediator there will
	 * be no further response.
	 * 
	 * Added for the fix deployed in version 2.0.4
	 */
	public function _testMediatorReregistration()
	{
		// Get the Singleton View instance
  		$view = View::getInstance();
		
		// Create and register that responds to notification 5
		$view->registerMediator( new ViewTestMediator5( $this ) );
		
		// try to register another instance of that mediator (uses the same NAME constant).
		$view->registerMediator( new ViewTestMediator5( $this ) );
		
		// test that the counter is only incremented once (mediator 5's response) 
		$this->counter = 0;
   		$view->notifyObservers( new Notification(ViewTest::NOTE5) );
   		$this->assertEquals( 1, $this->counter, "Expecting counter == 1" );

		// Remove the Mediator 
		$view->removeMediator( ViewTestMediator5::NAME );

		// test that retrieving it now returns null			
   		$this->assertTrue( $view->retrieveMediator( ViewTestMediator5::NAME ) == null, 
   								"Expecting $view->retrieveMediator( ViewTestMediator5.NAME ) == null" );

		// test that the counter is no longer incremented  
		$this->counter = 0;
   		$view->notifyObservers( new Notification(ViewTest::NOTE5) );
   		$this->assertEquals( 0, $this->counter, "Expecting counter == 0" );
	}
	
	/**
	 * Tests the ability for the observer list to 
	 * be modified during the process of notification,
	 * and all observers be properly notified. This
	 * happens most often when multiple Mediators
	 * respond to the same notification by removing
	 * themselves.  
	 * 
	 * Added for the fix deployed in version 2.0.4
	 */
	public function _testModifyObserverListDuringNotification()
	{
		// Get the Singleton View instance
  		$view = View::getInstance();
		
		// Create and register several mediator instances that respond to notification 6 
		// by removing themselves, which will cause the observer list for that notification 
		// to change. versions prior to Standard Version 2.0.4 will see every other mediator
		// fails to be notified.  
		$view->registerMediator( new ViewTestMediator6(ViewTestMediator6+"/1", $this) );
		$view->registerMediator( new ViewTestMediator6(ViewTestMediator6+"/2", $this) );
		$view->registerMediator( new ViewTestMediator6(ViewTestMediator6+"/3", $this) );
		$view->registerMediator( new ViewTestMediator6(ViewTestMediator6+"/4", $this) );
		$view->registerMediator( new ViewTestMediator6(ViewTestMediator6+"/5", $this) );
		$view->registerMediator( new ViewTestMediator6(ViewTestMediator6+"/6", $this) );
		$view->registerMediator( new ViewTestMediator6(ViewTestMediator6+"/7", $this) );
		$view->registerMediator( new ViewTestMediator6(ViewTestMediator6+"/8", $this) );

		// clear the counter
		$this->counter = 0;
		// send the notification. each of the above mediators will respond by removing
		// themselves and incrementing the counter by 1. This should leave us with a
		// count of 8, since 8 mediators will respond.
		$view->notifyObservers( new Notification( ViewTest::NOTE6 ) );
		// verify the count is correct
   		$this->assertEquals( 8, $this->counter, "Expecting counter == 8" );

		// clear the counter
		$this->counter = 0;
		$view->notifyObservers( new Notification( ViewTest::NOTE6 ) );
		// verify the count is 0
   		$this->assertEquals( 0, $this->counter, "Expecting counter == 0" );
	}

    /**
     * A utility method to test the notification of Observers by the view
     *
     * @param INotification $note
     */
	public function viewTestMethod( INotification $note )
	{
		$this->viewTestVar = $note->getBody();
	}
	
	/**
	 * Cleanup utility
	 */
	private function cleanup()
	{
        View::getInstance()->removeMediator( ViewTestMediator::NAME );
        View::getInstance()->removeMediator( ViewTestMediator2::NAME );
        View::getInstance()->removeMediator( ViewTestMediator3::NAME );
	}
}

