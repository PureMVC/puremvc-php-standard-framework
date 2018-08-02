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

/**
 * A base <code>INotification</code> implementation.
 * 
 * @see org.puremvc.php.patterns.observer.Observer Observer
 */
class Notification implements INotification
{
    // the name of the notification instance
    private $name;
    // the type of the notification instance
    private $type;
    // the body of the notification instance
    private $body;

    /**
     * Constructor. 
     * 
     * @param name name of the <code>Notification</code> instance. (required)
     * @param body the <code>Notification</code> body. (optional)
     * @param type the type of the <code>Notification</code> (optional)
     * @param mixed $name
     * @param null|mixed $body
     * @param null|mixed $type
     */
    public function __construct($name, $body = null, $type = null)
    {
        $this->name = $name;
        $this->body = $body;
        $this->type = $type;
    }

    /**
     * Get the name of the <code>Notification</code> instance.
     * 
     * @return the name of the <code>Notification</code> instance.
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the body of the <code>Notification</code> instance.
     * @param mixed $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * Get the body of the <code>Notification</code> instance.
     * 
     * @return the body object. 
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set the type of the <code>Notification</code> instance.
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * Get the type of the <code>Notification</code> instance.
     * 
     * @return the type  
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Get the string representation of the <code>Notification</code> instance.
     * 
     * @return the string representation of the <code>Notification</code> instance.
     */
    public function toString()
    {
        $msg = 'Notification Name: ' . $this->getName();
        $msg .= "\nBody:";
        $msg .= (null === $this->body) ? 'null' : (is_array($this->body)? 'Array': $this->body);
        $msg .= "\nType:";
        $msg .= (null === $this->type) ? 'null' : $this->type;

        return $msg;
    }
}
