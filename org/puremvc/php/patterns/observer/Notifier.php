<?php
/*
 PureMVC PHP Port by Asbjørn Sloth Tønnesen <asbjorn.tonnesen@puremvc.org>
 PureMVC - Copyright(c) 2006-08 Futurescale, Inc., Some rights reserved.
 Your reuse is governed by the Creative Commons Attribution 3.0 Unported License
*/

/**
 * A Base <code>INotifier</code> implementation.
 * 
 * <P>
 * <code>MacroCommand, Command, Mediator</code> and <code>Proxy</code> 
 * all have a need to send <code>Notifications</code>. <P>
 * <P>
 * The <code>INotifier</code> interface provides a common method called
 * <code>sendNotification</code> that relieves implementation code of 
 * the necessity to actually construct <code>Notifications</code>.</P>
 * 
 * <P>
 * The <code>Notifier</code> class, which all of the above mentioned classes
 * extend, provides an initialized reference to the <code>Facade</code>
 * Singleton, which is required for the convienience method
 * for sending <code>Notifications</code>, but also eases implementation as these
 * classes have frequent <code>Facade</code> interactions and usually require
 * access to the facade anyway.</P>
 * 
 * @see org.puremvc.php.patterns.facade.Facade Facade
 * @see org.puremvc.php.patterns.mediator.Mediator Mediator
 * @see org.puremvc.php.patterns.proxy.Proxy Proxy
 * @see org.puremvc.php.patterns.command.SimpleCommand SimpleCommand
 * @see org.puremvc.php.patterns.command.MacroCommand MacroCommand
 */
abstract class Notifier
{
  /**
   * Send an <code>INotification</code>s.
   * 
   * <P>
   * Keeps us from having to construct new notification 
   * instances in our implementation code.
   * @param notificationName the name of the notiification to send
   * @param body the body of the notification (optional)
   * @param type the type of the notification (optional)
   */ 
  public function sendNotification( $notificationName, Object $body=null, $type=null ) 
  {
    $this->facade->sendNotification( $notificationName, $body, $type );
  }
  
  public function __constructor()
  {
    $this->facade = Facade::getInstance();
    parent::__constructor();
  }

  // Local reference to the Facade Singleton
  protected $facade;
}
?>
