<?php
/*
 PureMVC PHP Port by Asbjørn Sloth Tønnesen <asbjorn.tonnesen@puremvc.org>
 PureMVC - Copyright(c) 2006-08 Futurescale, Inc., Some rights reserved.
 Your reuse is governed by the Creative Commons Attribution 3.0 Unported License
*/

/**
 * A base <code>INotification</code> implementation.
 * 
 * @see org.puremvc.php.patterns.observer.Observer Observer
 * 
 */
class Notification implements INotification
{
  
  /**
   * Constructor. 
   * 
   * @param name name of the <code>Notification</code> instance. (required)
   * @param body the <code>Notification</code> body. (optional)
   * @param type the type of the <code>Notification</code> (optional)
   */
  public function Notification( $name, Object $body=null, $type=null )
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
   */
  public function setBody( Object $body)
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
   */
  public function setType( $type )
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
    $msg = "Notification Name: " . $this->getName();
    $msg .= "\nBody:" . ( $this->body == null ?"null":$this->body);
    $msg .= "\nType:" . ( $this->type == null ?"null":$this->type);
    return $msg;
  }
  
  // the name of the notification instance
  private $name;
  // the type of the notification instance
  private $type;
  // the body of the notification instance
  private $body;
  
}
?>
