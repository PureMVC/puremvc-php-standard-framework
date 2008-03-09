<?php
/*
 PureMVC PHP Port by Asbjørn Sloth Tønnesen <asbjorn.tonnesen@puremvc.org>
 PureMVC - Copyright(c) 2006-08 Futurescale, Inc., Some rights reserved.
 Your reuse is governed by the Creative Commons Attribution 3.0 Unported License
*/

/**
 * A base <code>IMediator</code> implementation. 
 * 
 * @see org.puremvc.core.view.View View
 */
class Mediator extends Notifier implements IMediator, INotifier
{

  /**
   * The name of the <code>Mediator</code>. 
   * 
   * <P>
   * Typically, a <code>Mediator</code> will be written to serve
   * one specific control or group controls and so,
   * will not have a need to be dynamically named.</P>
   */
  const NAME = 'Mediator';
  
  /**
   * Constructor.
   */
  public function __construct( $mediatorName, Object $viewComponent=null ) {
    $this->viewComponent = $viewComponent;
    $this->mediatorName = ($mediatorName != null)?$mediatorName:self::NAME; 
  }

  /**
   * Get the name of the <code>Mediator</code>.
   * <P>
   * Override in subclass!</P>
   */		
  public function getMediatorName() 
  {	
    return $this->mediatorName;
  }

  /**
   * Get the <code>Mediator</code>'s view component.
   */		
  public function getViewComponent()
  {	
    return $this->viewComponent;
  }

  /**
   * List the <code>INotification</code> names this
   * <code>Mediator</code> is interested in being notified of.
   * 
   * @return Array the list of <code>INotification</code> names 
   */
  public function listNotificationInterests()
  {
    return array();
  }

  /**
   * Handle <code>INotification</code>s.
   * 
   * <P>
   * Typically this will be handled in a switch statement,
   * with one 'case' entry per <code>INotification</code>
   * the <code>Mediator</code> is interested in.
   */ 
  public function handleNotification( INotification $notification ) {}
  
  /**
   * Called when the View registers a Mediator.
   */
  public function onRemove( )
  {
     return;
  }
  
  /**
   * Called when the View removes a Mediator.
   */
  public function onRemove( )
  {
  	return;
  }

  // the mediator name
  protected $mediatorName;

  // The view component
  protected $viewComponent;
}
?>
