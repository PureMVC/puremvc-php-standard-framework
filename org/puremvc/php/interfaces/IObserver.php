<?php
namespace puremvc\php\interfaces;
use puremvc\php\interfaces\INotification;
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

/**
 * The interface definition for a PureMVC Observer.
 *
 * <P>
 * In PureMVC, <code>IObserver</code> implementors assume these responsibilities:
 * <UL>
 * <LI>Encapsulate the notification (callback) method of the interested object.</LI>
 * <LI>Encapsulate the notification context (this) of the interested object.</LI>
 * <LI>Provide methods for setting the interested object' notification method and context.</LI>
 * <LI>Provide a method for notifying the interested object.</LI>
 * </UL>
 * 
 * <P>
 * PureMVC does not rely upon underlying event
 * models such as the one provided with Flash,
 * and ActionScript 3 does not have an inherent
 * event model.</P>
 * 
 * <P>
 * The Observer Pattern as implemented within
 * PureMVC exists to support event driven communication
 * between the application and the actors of the
 * MVC triad.</P>
 * 
 * <P> 
 * An Observer is an object that encapsulates information
 * about an interested object with a notification method that
 * should be called when an </code>INotification</code> is broadcast. The Observer then
 * acts as a proxy for notifying the interested object.
 * 
 * <P>
 * Observers can receive <code>Notification</code>s by having their
 * <code>notifyObserver</code> method invoked, passing
 * in an object implementing the <code>INotification</code> interface, such
 * as a subclass of <code>Notification</code>.</P>
 * 
 * @see org.puremvc.php.interfaces.IView IView
 * @see org.puremvc.php.interfaces.INotification INotification
 */
interface IObserver
{
    /**
     * Set the notification method.
     *
     * <P>
     * The notification method should take one parameter of type <code>INotification</code></P>
     *
     * @param mixed $notifyMethod
     * @return
     */
    public function setNotifyMethod($notifyMethod);

    /**
     * Set the notification context.
     *
     * @param mixed $notifyContext
     * @return
     */
    public function setNotifyContext($notifyContext);

    /**
     * Notify the interested object.
     *
     * @param INotification $notification
     * @return
     */
    public function notifyObserver(INotification $notification);

    /**
     * Compare the given object to the notificaiton context object.
     *
     * @param mixed $object
     * @return bool indicating if the notification context and the object are the same.
     */
    public function compareNotifyContext($object);
}
