<?php
/*
 PureMVC PHP Port by Asbjørn Sloth Tønnesen <asbjorn.tonnesen@puremvc.org>
 PureMVC - Copyright(c) 2006, 2007 FutureScale, Inc., Some rights reserved.
 Your reuse is governed by the Creative Commons Attribution 3.0 Unported License
*/
	
/**
 * A Singleton <code>IController</code> implementation.
 * 
 * <P>
 * In PureMVC, the <code>Controller</code> class follows the
 * 'Command and Controller' strategy, and assumes these 
 * responsibilities:
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
 * <P>
 * Your application must register <code>ICommands</code> with the 
 * Controller.
 * <P>
 * The simplest way is to subclass </code>Facade</code>, 
 * and use its <code>initializeController</code> method to add your 
 * registrations. 
 * 
 * @package org.puremvc.php.core.controller.Controller
 * @see org.puremvc.core.view.View View
 * @see org.puremvc.patterns.observer.Observer Observer
 * @see org.puremvc.patterns.observer.Notification Notification
 * @see org.puremvc.patterns.command.SimpleCommand SimpleCommand
 * @see org.puremvc.patterns.command.MacroCommand MacroCommand
 */
class Controller implements IController
{
  
  /**
   * Constructor. 
   * 
   * <P>
   * This <code>IController</code> implementation is a Singleton, 
   * so you should not call the constructor 
   * directly, but instead call the static Singleton 
   * Factory method <code>Controller.getInstance()</code>
   * 
   * @throws Error Error if Singleton instance has already been constructed
   * 
   */
  private function __construct( )
  {
    $instance = $this;
    $this->commandMap = array();
    $this->initializeController();	
  }
  
  /**
   * Initialize the Singleton <code>Controller</code> instance.
   * 
   * <P>Called automatically by the constructor.</P> 
   * 
   * <P>Note that if you are using a subclass of <code>View</code>
   * in your application, you should <i>also</i> subclass <code>Controller</code>
   * and override the <code>initializeController</code> method in the 
   * following way:</P>
   * 
   * <listing>
   *		// ensure that the Controller is talking to my IView implementation
   *		override public function initializeController(  ) : void 
   *		{
   *			view = MyView.getInstance();
   *		}
   * </listing>
   * 
   * @return void
   */
  protected function initializeController(  )
  {
    $view = View::getInstance();
  }

  /**
   * <code>Controller</code> Singleton Factory method.
   * 
   * @return the Singleton instance of <code>Controller</code>
   */
  public static function getInstance()
  {
    if ( $this->instance == null ) $this->instance = new Controller();
    return $this->instance;
  }

  /**
   * If an <code>ICommand</code> has previously been registered 
   * to handle a the given <code>INotification</code>, then it is executed.
   * 
   * @param note an <code>INotification</code>
   */
  public function executeCommand( INotification $note )
  {
    $commandClassRef = $this->commandMap[ $note->getName() ];
    if ( $commandClassRef == null ) return;

    $commandInstance = new commandClassRef();
    $commandInstance->execute( $note );
  }

  /**
   * Register a particular <code>ICommand</code> class as the handler 
   * for a particular <code>INotification</code>.
   * 
   * <P>
   * If an <code>ICommand</code> has already been registered to 
   * handle <code>INotification</code>s with this name, it is no longer
   * used, the new <code>ICommand</code> is used instead.</P>
   * 
   * @param notificationName the name of the <code>INotification</code>
   * @param commandClassRef the <code>Class</code> of the <code>ICommand</code>
   */
  public function registerCommand( $notificationName, object $commandClassRef )
  {
    $this->commandMap[$notificationName] = $commandClassRef;
    $this->view->registerObserver( $notificationName, new Observer( array($this, "executeCommand") ) );
  }
  
  /**
   * Remove a previously registered <code>ICommand</code> to <code>INotification</code> mapping.
   * 
   * @param notificationName the name of the <code>INotification</code> to remove the <code>ICommand</code> mapping for
   */
  public function removeCommand( $notificationName )
  {
    $this->commandMap[ $notificationName ] = null;
  }
  
  // Local reference to View 
  protected $view;
  
  // Mapping of Notification names to Command Class references
  protected $commandMap;

  // Singleton instance
  protected static $instance;

}
?>
