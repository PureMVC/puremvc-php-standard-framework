<?php
namespace puremvc\php\interfaces;
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
 * The interface definition for a PureMVC Notification.
 *
 * @see org.puremvc.php.interfaces.IView IView
 * @see org.puremvc.php.interfaces.IObserver IObserver
 */
interface INotification
{
    /**
     * Get the name of the <code>INotification</code> instance. 
     * No setter, should be set by constructor only
     *
     * @return string
     */
    public function getName();

    /**
     * Set the body of the <code>INotification</code> instance
     * @param mixed $body
     */
    public function setBody($body);

    /**
     * Get the body of the <code>INotification</code> instance
     */
    public function getBody();

    /**
     * Set the type of the <code>INotification</code> instance
     * @param mixed $type
     * @return
     */
    public function setType($type);

    /**
     * Get the type of the <code>INotification</code> instance
     *
     * @return string
     */
    public function getType();

    /**
     * Get the string representation of the <code>INotification</code> instance
     *
     * @return string
     */
    public function toString();
}
