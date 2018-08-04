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
use puremvc\php\interfaces\INotification;
/**
 * A Mediator class used by ViewTest.
 * 
 * @see org.puremvc.php.core.view.ViewTest ViewTest
 */
class ViewTestMediator3 extends Mediator implements IMediator
{
	const NAME = 'ViewTestMediator3';

    /**
     * Constructor
     * @param      $mediatorName
     * @param null $viewComponent
     */
	public function __construct( $mediatorName, $viewComponent = null )
	{
		parent::__construct( ViewTestMediator3::NAME, $viewComponent );
	}

    /**
     * The Notification(s) this IMediator is interested in.
     *
     * @return array <code>Array</code> of the <code>INotification</code> names this <code>IMediator</code> has an interest in.
     * @see IMediator::listNotificationInterests()
     */
	public function listNotificationInterests()
	{
		// be sure that the mediator has some Observers created
		// in order to test removeMediator
		return array( ViewTest::NOTE3 );
	}

    /**
     *
     * @param INotification $notification
     * @see IMediator::handleNotification()
     */
	public function handleNotification( INotification $notification )
	{
		$this->viewTest()->lastNotification = $notification->getName();
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
