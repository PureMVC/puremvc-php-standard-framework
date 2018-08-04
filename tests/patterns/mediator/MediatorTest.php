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
use puremvc\php\patterns\mediator\Mediator;

/**
 * Test the PureMVC Mediator class.
 * 
 * @see org.puremvc.php.interfaces.IMediator IMediator
 * @see org.puremvc.php.patterns.mediator.Mediator Mediator
 */
class MediatorTest extends \PHPUnit\Framework\TestCase
{	
	/**
	 * @var Mediator
	 */
	private $Mediator;
	
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
	 * Tests getting the name using Mediator class accessor method.
	 */
	public function testNameAccessor()
	{
		// Create a new Mediator and use accessors to set the mediator name 
   		$mediator = new Mediator( '' );
   		
   		// test assertions
   		$this->assertTrue( $mediator->getMediatorName() == Mediator::NAME, "Expecting mediator->getMediatorName() == Mediator::NAME" );
	}
	
	/**
	 * Tests getting the name using Mediator class accessor method.
	 */
	public function testViewAccessor()
	{
		// Create a view object
		$view = new stdClass();
		
		// Create a new Mediator and use accessors to set the mediator name 
   		$mediator = new Mediator( Mediator::NAME, $view );
		   			
   		// test assertions
   		$this->assertNotNull( $mediator->getViewComponent(), "Expecting mediator.getViewComponent() not null" );
	}
}

