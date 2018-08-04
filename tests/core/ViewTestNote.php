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
use puremvc\php\interfaces\INotification;
use puremvc\php\patterns\observer\Notification;
/**
 * A Notification class used by ViewTest.
 * 
 * @see org.puremvc.php.core.view.ViewTest ViewTest
 */
class ViewTestNote extends Notification implements INotification
{
	/**
	 * The name of this Notification.
	 */
	const NAME = 'ViewTestNote';
	/**
	 * Constructor
	 * 
	 *@param name Ignored and forced to NAME.
	 *@param body the <code>Notification</code> body. (optional) 
	 *@param type the type of the <code>Notification</code> (optional) 
	 */
	public function __construct( $name, $body = null )
	{
		parent::__construct( ViewTestNote::NAME, $body );
	}

    /**
     * Factory method.
     *
     * <P>
     * This method creates new instances of the ViewTestNote class,
     * automatically setting the note name so you don't have to. Use
     * this as an alternative to the constructor.</P>
     *
     * @param name the name of the Notification to be constructed.
     * @param body the body of the Notification to be constructed.
     * @return \ViewTestNote
     */
	public static function create( $body )
	{
		return new ViewTestNote( ViewTestNote::NAME, $body );
	}
}

?>
