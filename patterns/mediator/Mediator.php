<?php
/*
 PureMVC PHP Port by Asbjørn Sloth Tønnesen <asbjorn.tonnesen@puremvc.org>
 PureMVC - Copyright(c) 2006, 2007 FutureScale, Inc., Some rights reserved.
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
  public function __construct( Object $viewComponent=null ) {
    $this->viewComponent = $viewComponent;	
  }

  /**
   * Get the name of the <code>Mediator</code>.
   * <P>
   * Override in subclass!</P>
   */		
  public function getMediatorName() 
  {	
    return Mediator::NAME;
  }

  /**
   * Get the <code>Mediator</code>'s view component.
   * 
   * <P>
   * Additionally, an implicit getter will usually
   * be defined in the subclass that casts the view 
   * object to a type, like this:</P>
   * 
   * <listing>
   *		private function get comboBox : mx.controls.ComboBox 
   *		{
   *			return viewComponent as mx.controls.ComboBox;
   *		}
   * </listing>
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
  
  // The view component
  protected $viewComponent;
}
?>
