<?php
namespace puremvc\php\interfaces;
use puremvc\php\interfaces\IObserver;
use puremvc\php\interfaces\INotification;
use puremvc\php\interfaces\IMediator;
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
 * The interface definition for a PureMVC View.
 * 
 * <P>
 * In PureMVC, <code>IView</code> implementors assume these responsibilities:</P>
 * 
 * <P>
 * In PureMVC, the <code>View</code> class assumes these responsibilities:
 * <UL>
 * <LI>Maintain a cache of <code>IMediator</code> instances.</LI>
 * <LI>Provide methods for registering, retrieving, and removing <code>IMediators</code>.</LI>
 * <LI>Managing the observer lists for each <code>INotification</code> in the application.</LI>
 * <LI>Providing a method for attaching <code>IObservers</code> to an <code>INotification</code>'s observer list.</LI>
 * <LI>Providing a method for broadcasting an <code>INotification</code>.</LI>
 * <LI>Notifying the <code>IObservers</code> of a given <code>INotification</code> when it broadcast.</LI>
 * </UL>
 * 
 * @see org.puremvc.php.interfaces.IMediator IMediator
 * @see org.puremvc.php.interfaces.IObserver IObserver
 * @see org.puremvc.php.interfaces.INotification INotification
 */
interface IView
{
    /**
     * Register an <code>IObserver</code> to be notified
     * of <code>INotifications</code> with a given name.
     *
     * @param mixed                             $noteName
     * @param IObserver $observer
     * @return
     */
    public function registerObserver($noteName, IObserver $observer);

    /**
     * Notify the <code>IObservers</code> for a particular <code>INotification</code>.
     *
     * <P>
     * All previously attached <code>IObservers</code> for this <code>INotification</code>'s
     * list are notified and are passed a reference to the <code>INotification</code> in
     * the order in which they were registered.</P>
     *
     * @param INotification $note
     * @return
     */
    public function notifyObservers(INotification $note);

    /**
     * Register an <code>IMediator</code> instance with the <code>View</code>.
     *
     * <P>
     * Registers the <code>IMediator</code> so that it can be retrieved by name,
     * and further interrogates the <code>IMediator</code> for its
     * <code>INotification</code> interests.</P>
     * <P>
     * If the <code>IMediator</code> returns any <code>INotification</code>
     * names to be notified about, an <code>Observer</code> is created encapsulating
     * the <code>IMediator</code> instance's <code>handleNotification</code> method
     * and registering it as an <code>Observer</code> for all <code>INotifications</code> the
     * <code>IMediator</code> is interested in.</p>
     *
     * @param IMediator $mediator
     * @return
     */
    public function registerMediator(IMediator $mediator);

    /**
     * Retrieve an <code>IMediator</code> from the <code>View</code>.
     *
     * @param mixed $mediatorName
     * @return IMediator the <code>IMediator</code> instance previously registered with the given <code>mediatorName</code>.
     */
    public function retrieveMediator($mediatorName);

    /**
     * Remove an <code>IMediator</code> from the <code>View</code>.
     *
     * @param mixed $mediatorName
     * @return
     */
    public function removeMediator($mediatorName);

    /**
     * Check to see if a Mediator is registered with the View.
     *
     * @param mixed $mediatorName
     * @return
     */
    public function hasMediator($mediatorName);
}
