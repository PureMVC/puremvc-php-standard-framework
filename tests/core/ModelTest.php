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
use puremvc\php\core\Model;
use puremvc\php\patterns\proxy\Proxy;

require_once 'ModelTestProxy.php';

/**
 * Test the PureMVC Model class.
 */
class ModelTest extends \PHPUnit\Framework\TestCase
{
	/**
	 * Used for class reflection.
	 *
	 * @var ReflectionClass
	 */
	private $classReflector;
	/**
	 * @var Model
	 */
	private $model;
	
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
     * Tests the Model Singleton Factory Method
     * @throws \ReflectionException
     */
	public function testGetInstance()
	{
		// Test Factory Method
   		$model = Model::getInstance();
   		
   		// test assertion - Model::getInstance() non-null
   		$this->assertNotNull($model, 'Expecting instance not null');
   		
   		// utilize reflection for the interface test assertion
   		$this->classReflector = new \ReflectionClass( $model );
   		$interfaces = $this->classReflector->getInterfaces();
   		
   		foreach ($interfaces as $interface)
   		{
   			$hasInterface = ($interface->name == 'puremvc\php\interfaces\IModel') ? true : false;
   			if ($hasInterface) break;
   		}
   		
   		// test assertion - Model implement IModel
   		$this->assertTrue( $hasInterface, 'Class instance implements IModel' );
	}
	
	/**
	 * Tests the proxy registration and retrieval methods.
	 * 
	 * <P>
  	 * Tests <code>registerProxy</code> and <code>retrieveProxy</code> in the same test.
  	 * These methods cannot currently be tested separately
  	 * in any meaningful way other than to show that the
  	 * methods do not throw exception when called. </P>
	 */
	public function testRegisterAndRetrieveProxy()
	{
		// register a proxy and retrieve it.
   		$model = Model::getInstance();
		$model->registerProxy( new Proxy('colors', ['red', 'green', 'blue']) );
		$proxy = $model->retrieveProxy( 'colors' );
		$data = $proxy->getData();
		
		// test assertions
   		 $this->assertNotNull($data, 'Expecting data not null');
   		 $this->assertTrue(is_array($data), 'Expecting data type is Array');
   		 $this->assertTrue( count($data) == 3, 'Expecting data.length == 3');
   		 $this->assertTrue( $data[0]  == 'red', "Expecting data[0] == 'red'" );
   		 $this->assertTrue( $data[1]  == 'green', "Expecting data[1] == 'green'" );
   		 $this->assertTrue( $data[2]  == 'blue', "Expecting data[2] == 'blue'" );
	}
	
	/**
	 * Tests the proxy removal method.
	 */
	public function testRegisterAndRemoveProxy()
	{
		// register a proxy, remove it, then try to retrieve it
   		$model = Model::getInstance();
   		$proxy = new Proxy('sizes', ['7', '13', '21']);
		$model->registerProxy( $proxy );

		// remove the proxy
		$removedProxy = $model->removeProxy( 'sizes' );
		
		// assert that we removed the appropriate proxy
   		$this->assertTrue( $removedProxy->getProxyName() == 'sizes', 
   								"Expecting removedProxy.getProxyName() == 'sizes'" );
		
		// ensure that the proxy is no longer retrievable from the $model
		$proxy = $model->retrieveProxy( 'sizes' );
		
		// test assertions
   		$this->assertNull($proxy, 'Expecting proxy is null');
	}
	
	/**
	 * Tests the hasProxy Method
	 */
	public function testHasProxy()
	{
		// register a proxy
   		$model = Model::getInstance();
   		$proxy = new Proxy('aces', ['clubs', 'spades', 'hearts', 'diamonds']);
		$model->registerProxy( $proxy );
		
   		// assert that the model.hasProxy method returns true
   		// for that proxy name
   		$this->assertTrue( $model->hasProxy('aces') == true, 
   								"Expecting model.hasProxy('aces') == true" );
		
		// remove the proxy
		$model->removeProxy( 'aces' );
		
   		// assert that the model.hasProxy method returns false
   		// for that proxy name
   		$this->assertTrue( $model->hasProxy('aces') == false, 
   								"Expecting model.hasProxy('aces') == false" );
	}
	
	/**
	 * Tests that the Model calls the onRegister and onRemove methods.
	 */
	public function testOnRegisterAndOnRemove()
	{
		// Get the Singleton View instance
  		$model = Model::getInstance();

		// Create and register the test mediator
		$proxy = new ModelTestProxy();
		$model->registerProxy( $proxy );

		// assert that onRegsiter was called, and the proxy responded by setting its data accordingly
   		$this->assertTrue( $proxy->getData() == ModelTestProxy::ON_REGISTER_CALLED, 'Expecting proxy.getData() == ModelTestProxy.ON_REGISTER_CALLED');
		
		// Remove the component
		$model->removeProxy( ModelTestProxy::NAME );
		
		// assert that onRemove was called, and the proxy responded by setting its data accordingly
   		$this->assertTrue( $proxy->getData() == ModelTestProxy::ON_REMOVE_CALLED, 'Expecting proxy.getData() == ModelTestProxy.ON_REMOVE_CALLED');
	}
}

