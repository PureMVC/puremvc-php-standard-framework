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
 * The interface definition for a PureMVC Controller.
 * 
 * <P>
 * In PureMVC, an <code>IController</code> implementor 
 * follows the 'Command and Controller' strategy, and 
 * assumes these responsibilities:
 * <UL>
 * <LI> Remembering which <code>ICommand</code>s 
 * are intended to handle which <code>INotifications</code>.</LI>
 * <LI> Registering itself as an <code>IObserver</code> with
 * the <code>View</code> for each <code>INotification</code> 
 * that it has an <code>ICommand</code> mapping for.</LI>
 * <LI> Creating a new instance of the proper <code>ICommand</code>
 * to handle a given <code>INotification</code> when notified by the <code>View</code>.</LI>
 * <LI> Calling the <code>ICommand</code>'s <code>execute</code>
 * method, passing in the <code>INotification</code>.</LI> 
 * </UL>
 *
 * @see org.puremvc.php.interfaces INotification
 * @see org.puremvc.php.interfaces ICommand
 */
interface IController
{
    /**
     * Register a particular <code>ICommand</code> class as the handler
     * for a particular <code>INotification</code>.
     *
     * @param mixed $notificationName
     * @param mixed $commandClassRef
     * @return
     */
    public function registerCommand($notificationName, $commandClassRef);

    /**
     * Execute the <code>ICommand</code> previously registered as the
     * handler for <code>INotification</code>s with the given notification name.
     *
     * @param INotification $notification
     * @return
     */
    public function executeCommand(INotification $notification);

    /**
     * Remove a previously registered <code>ICommand</code> to <code>INotification</code> mapping.
     *
     * @param mixed $notificationName
     * @return
     */
    public function removeCommand($notificationName);
}
