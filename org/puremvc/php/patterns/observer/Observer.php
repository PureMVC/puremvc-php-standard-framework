<?php
/**
 * PureMVC Port to PHP originally translated by Asbjørn Sloth Tønnesen
 *
 * @author Omar Gonzalez :: omar@almerblank.com
 * @author Hasan Otuome :: hasan@almerblank.com 
 * 
 * Created on Sep 24, 2008
 * PureMVC - Copyright(c) 2006-2008 Futurescale, Inc., Some rights reserved.
 * Your reuse is governed by the Creative Commons Attribution 3.0 Unported License
 */
require_once 'org/puremvc/php/interfaces/INotification.php';
require_once 'org/puremvc/php/interfaces/IObserver.php';

/**
 * A base <code>IObserver</code> implementation.
 * 
 * <P> 
 * An <code>Observer</code> is an object that encapsulates information
 * about an interested object with a method that should 
 * be called when a particular <code>INotification</code> is broadcast. </P>
 * 
 * <P>
 * In PureMVC, the <code>Observer</code> class assumes these responsibilities:
 * <UL>
 * <LI>Encapsulate the notification (callback) method of the interested object.</LI>
 * <LI>Encapsulate the notification context (this) of the interested object.</LI>
 * <LI>Provide methods for setting the notification method and context.</LI>
 * <LI>Provide a method for notifying the interested object.</LI>
 * </UL>
 * 
 * @see org.puremvc.php.core.View View
 * @see org.puremvc.php.patterns.observer.Notification Notification
 */
class Observer implements IObserver
{
    private $notify;
    private $context;

    /**
     * Constructor. 
     * 
     * <P>
     * The notification method on the interested object should take 
     * one parameter of type <code>INotification</code></P>
     * 
     * @param notifyMethod the notification method of the interested object
     * @param notifyContext the notification context of the interested object
     * @param mixed $notifyMethod
     * @param mixed $notifyContext
     */
    public function __construct($notifyMethod, $notifyContext)
    {
        $this->setNotifyMethod($notifyMethod);
        $this->setNotifyContext($notifyContext);
    }

    /**
     * Set the notification method.
     * 
     * <P>
     * The notification method should take one parameter of type <code>INotification</code>.</P>
     * 
     * @param notifyMethod the notification (callback) method of the interested object.
     * @param mixed $notifyMethod
     */
    public function setNotifyMethod($notifyMethod)
    {
        $this->notify = $notifyMethod;
    }

    /**
     * Set the notification context.
     * 
     * @param notifyContext the notification context (this) of the interested object.
     * @param mixed $notifyContext
     */
    public function setNotifyContext($notifyContext)
    {
        $this->context = $notifyContext;
    }

    /**
     * Get the notification method.
     * 
     * @return the notification (callback) method of the interested object.
     */
    private function getNotifyMethod()
    {
        return $this->notify;
    }

    /**
     * Get the notification context.
     * 
     * @return the notification context (<code>this</code>) of the interested object.
     */
    private function getNotifyContext()
    {
        return $this->context;
    }

    /**
     * Notify the interested object.
     * 
     * @param notification the <code>INotification</code> to pass to the interested object's notification method.
     */
    public function notifyObserver(INotification $notification)
    {
        $context = $this->getNotifyContext();
        $method = $this->getNotifyMethod();

        $context->$method($notification);
    }

    /**
     * Compare an object to the notification context. 
     * 
     * @param object the object to compare
     * @param mixed $object
     * @return bool indicating if the object and the notification context are the same
     */
    public function compareNotifyContext($object)
    {
        return $object === $this->context;
    }
}
