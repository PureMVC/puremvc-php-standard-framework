<?php
/*
 PureMVC PHP Port by Asbjørn Sloth Tønnesen <asbjorn.tonnesen@puremvc.org>
 PureMVC - Copyright(c) 2006-08 Futurescale, Inc., Some rights reserved.
 Your reuse is governed by the Creative Commons Attribution 3.0 Unported License
*/

/**
 * A Singleton <code>IView</code> implementation.
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
 * @package org.puremvc.php.core.View
 * @see org.puremvc.php.patterns.mediator.Mediator Mediator
 * @see org.puremvc.php.patterns.observer.Observer Observer
 * @see org.puremvc.php.patterns.observer.Notification Notification
 */
class View implements IView
{
  
  /**
   * Constructor. 
   * 
   * <P>
   * This <code>IView</code> implementation is a Singleton, 
   * so you should not call the constructor 
   * directly, but instead call the static Singleton 
   * Factory method <code>View.getInstance()</code>
   * 
   * @throws Error Error if Singleton instance has already been constructed
   * 
   */
  private function __construct( )
  {
    $this->instance = $this;
    $this->mediatorMap = array();
    $this->observerMap = array();	
    $this->initializeView();	
  }
  
  /**
   * Initialize the Singleton View instance.
   * 
   * <P>
   * Called automatically by the constructor, this
   * is your opportunity to initialize the Singleton
   * instance in your subclass without overriding the
   * constructor.</P>
   * 
   * @return void
   */
  protected function initializeView(  )
  {
  }

  /**
   * View Singleton Factory method.
   * 
   * @return the Singleton instance of <code>View</code>
   */
  public static function getInstance()
  {
    if ( $this->instance == null ) $this->instance = new View( );
    return $this->instance;
  }
      
  /**
   * Register an <code>IObserver</code> to be notified
   * of <code>INotifications</code> with a given name.
   * 
   * @param notificationName the name of the <code>INotifications</code> to notify this <code>IObserver</code> of
   * @param observer the <code>IObserver</code> to register
   */
  public function registerObserver ( $notificationName, IObserver $observer )
  {
    if( $this->observerMap[ $notificationName ] != null ) {
      array_push($this->observerMap[ $notificationName ], $observer );
    } else {
      $this->observerMap[ $notificationName ] = array( $observer );	
    }
  }


  /**
   * Notify the <code>IObservers</code> for a particular <code>INotification</code>.
   * 
   * <P>
   * All previously attached <code>IObservers</code> for this <code>INotification</code>'s
   * list are notified and are passed a reference to the <code>INotification</code> in 
   * the order in which they were registered.</P>
   * 
   * @param notification the <code>INotification</code> to notify <code>IObservers</code> of.
   */
  public function notifyObservers( INotification $notification )
  {
    if( $this->observerMap[ $notification->getName() ] != null ) {
      $observers = $this->observerMap[ $notification->getName() ];
      foreach ($observers as $observer) {
        $observer->notifyObserver( $notification );
      }
    }
  }
          
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
   * @param mediatorName the name to associate with this <code>IMediator</code> instance
   * @param mediator a reference to the <code>IMediator</code> instance
   */
  public function registerMediator( IMediator $mediator )
  {
    // Register the Mediator for retrieval by name
    $this->mediatorMap[ $mediator->getMediatorName() ] = $mediator;
    
    // Get Notification interests, if any.
    $interests = $mediator->listNotificationInterests();
    if ( sizeof($interests) == 0) return;
    
    // Create Observer
    $observer = new Observer( array($mediator, "handleNotification"), $mediator );
    
    // Register Mediator as Observer for its list of Notification interests
    foreach ($interests as $interest) {
      registerObserver( $interest,  $observer );
    }			
    
    // Alert the Mediator that it has been registered
    $mediator->onRegister();
  }

  /**
   * Retrieve an <code>IMediator</code> from the <code>View</code>.
   * 
   * @param mediatorName the name of the <code>IMediator</code> instance to retrieve.
   * @return the <code>IMediator</code> instance previously registered with the given <code>mediatorName</code>.
   */
  public function retrieveMediator( $mediatorName )
  {
    return $this->mediatorMap[ $mediatorName ];
  }

  /**
   * Check to see if a Mediator is registered with the View.
   * 
   * @param mediatorName name of the <code>IMediator</code> instance to check for.
   */
  public function hasMediator( $mediatorName )
  {
	  return $this->mediatorMap[ $mediatorName ] != null;
  }

  /**
   * Remove an <code>IMediator</code> from the <code>View</code>.
   * 
   * @param mediatorName name of the <code>IMediator</code> instance to be removed.
   */
  public function removeMediator( $mediatorName )
  {
    // Remove all Observers with a reference to this Mediator			
    // also, when an notification's observer list length falls to 
    // zero, remove it.
    foreach ( $this->observerMap as &$observers ) {
      foreach ( $observers as &$observer ) {
        if ( $observer->compareNotifyContext( $this->retrieveMediator( $mediatorName ) ) == true ) {
          unset($observer);

          if ( sizeof($observers) == 0 ) {
            unset($observers);
            break;
          }
        }
      }
    }			
   	// get a reference to the mediator to be removed
    &$mediator = $this->mediatorMap[ $mediatorName ];
    
    // Remove the reference from the map
    unset($this->mediatorMap[ $mediatorName ]);
    
    // alert the mediator that it has been removed
    if ($mediator != null) { $mediator->onRemove(); );
    
    return $mediator;
  }
          
  // Mapping of Mediator names to Mediator instances
  protected $mediatorMap;

  // Mapping of Notification names to Observer lists
  protected $observerMap;
  
  // Singleton instance
  protected static $instance;
}
?>
