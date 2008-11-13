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
 
/**
 * The interface definition for a PureMVC Facade.
 *
 * <P>
 * The Facade Pattern suggests providing a single
 * class to act as a central point of communication 
 * for a subsystem. </P>
 * 
 * <P>
 * In PureMVC, the Facade acts as an interface between
 * the core MVC actors (Model, View, Controller) and
 * the rest of your application.</P>
 * 
 * @see org.puremvc.php.interfaces.IModel IModel
 * @see org.puremvc.php.interfaces.IView IView
 * @see org.puremvc.php.interfaces.IController IController
 * @see org.puremvc.php.interfaces.ICommand ICommand
 * @see org.puremvc.php.interfaces.INotification INotification
 */
interface IFacade
{
  /**
   * Register an <code>IProxy</code> with the <code>Model</code> by name.
   * 
   * @param proxy the <code>IProxy</code> to be registered with the <code>Model</code>.
   */
  public function registerProxy( IProxy $proxy );

  /**
   * Retrieve a <code>IProxy</code> from the <code>Model</code> by name.
   * 
   * @param proxyName the name of the <code>IProxy</code> instance to be retrieved.
   * @return the <code>IProxy</code> previously regisetered by <code>proxyName</code> with the <code>Model</code>.
   */
  public function retrieveProxy( $proxyName );
  
   /**
   * Check to see if a Proxy is registered with the Model.
   * 
   * @param proxyName name of the <code>IProxy</code> instance to check for.
   */
  public function hasProxy( $proxyName );
 
  /**
   * Remove an <code>IProxy</code> instance from the <code>Model</code> by name.
   *
   * @param proxyName the <code>IProxy</code> to remove from the <code>Model</code>.
   */
  public function removeProxy( $proxyName );
  
  /**
   * Register an <code>ICommand</code> with the <code>Controller</code>.
   * 
   * @param noteName the name of the <code>INotification</code> to associate the <code>ICommand</code> with.
   * @param commandClassRef a reference to the <code>Class</code> of the <code>ICommand</code>.
   */
  public function registerCommand( $noteName, $commandClassRef );
  
  /**
   * Notify <code>Observer</code>s of an <code>INotification</code>.
   * 
   * @param note the <code>INotification</code> to have the <code>View</code> notify observers of.
   */
  public function notifyObservers( INotification $note );
  
  /**
   * Register an <code>IMediator</code> instance with the <code>View</code>.
   * 
   * @param mediator a reference to the <code>IMediator</code> instance
   */
  public function registerMediator( IMediator $mediator );

  /**
   * Retrieve an <code>IMediator</code> instance from the <code>View</code>.
   * 
   * @param mediatorName the name of the <code>IMediator</code> instance to retrievve
   * @return the <code>IMediator</code> previously registered with the given <code>mediatorName</code>.
   */
  public function retrieveMediator( $mediatorName );

  /**
   * Check to see if a Mediator is registered with the View.
   * 
   * @param mediatorName name of the <code>IMediator</code> instance to check for.
   */
  public function hasMediator( $mediatorName );

  /**
   * Remove a <code>IMediator</code> instance from the <code>View</code>.
   * 
   * @param mediatorName name of the <code>IMediator</code> instance to be removed.
   */
  public function removeMediator( $mediatorName );

  /**
   * Send a <code>INotification</code>.
   * 
   * <P>
   * Convenience method to prevent having to construct new 
   * notification instances in our implementation code.</P>
   * 
   * @param notificationName the name of the notification to send
   * @param body the body of the notification (optional)
   * @param type the type of the notification (optional)
   */ 
  public function sendNotification( $notificationName, $body=null, $type=null ); 

}
?>
