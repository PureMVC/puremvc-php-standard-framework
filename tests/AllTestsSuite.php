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

require dirname(__DIR__) . '/vendor/autoload.php';
require dirname(__DIR__) . '/puremvc_autoloader.php';

require_once 'core/ControllerTest.php';
require_once 'core/ModelTest.php';
require_once 'core/ViewTest.php';

require_once 'patterns/command/MacroCommandTest.php';
require_once 'patterns/command/SimpleCommandTest.php';
require_once 'patterns/facade/FacadeTest.php';
require_once 'patterns/mediator/MediatorTest.php';
require_once 'patterns/observer/NotificationTest.php';
require_once 'patterns/observer/ObserverTest.php';
require_once 'patterns/proxy/ProxyTest.php';

/**
 * Static test suite.
 */
class AllTestsSuite extends PHPUnit\Framework\TestSuite
{
	/**
	 * Constructs the test suite handler.
	 */
	public function __construct()
	{
		$this->setName( 'AllTestsSuite' );
		$this->addTestSuite( 'ControllerTest' );
		$this->addTestSuite( 'ModelTest' );
		$this->addTestSuite( 'MediatorTest' );
		$this->addTestSuite( 'ProxyTest' );
		$this->addTestSuite( 'NotificationTest' );
		$this->addTestSuite( 'ObserverTest' );
		$this->addTestSuite( 'FacadeTest' );
		$this->addTestSuite( 'SimpleCommandTest' );
		$this->addTestSuite( 'MacroCommandTest' );
		$this->addTestSuite( 'ViewTest' );
	}
	
	/**
	 * Creates the suite.
	 */
	public static function suite()
	{
		return new self();
	}
}

