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
use puremvc\php\interfaces\IMediator;
use puremvc\php\patterns\mediator\Mediator;
/**
 * A Mediator class used by ViewTest.
 * 
 * @see org.puremvc.php.core.view.ViewTest ViewTest
 */
class ViewTestMediator4 extends Mediator implements IMediator
{
	const NAME = 'ViewTestMediator4';

    /**
     * Constructor
     * @param null $viewComponent
     */
	public function __construct( $viewComponent = null )
	{
		parent::__construct( ViewTestMediator4::NAME, $viewComponent );
	}
	
	/**
	 * 
	 * @see IMediator::onRegister()
	 */
	public function onRegister()
	{
		$this->viewTest()->onRegisterCalled = true;	
	}
	
	/**
	 * 
	 * @see IMediator::onRemove()
	 */
	public function onRemove()
	{
		$this->viewTest()->onRemoveCalled = true;
	}
	
	/**
	 * Returns the view component associated with this Mediator.
	 *
	 * @return mixed
	 */
	public function viewTest()
	{
		return $this->viewComponent;
	}
}

?>
