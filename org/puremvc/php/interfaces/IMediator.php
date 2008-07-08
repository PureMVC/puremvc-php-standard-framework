<?php
/*
 PureMVC Port to PHP Originally by Asbjørn Sloth Tønnesen
 PureMVC - Copyright(c) 2006-2008 Futurescale, Inc., Some rights reserved.
 Your reuse is governed by the Creative Commons Attribution 3.0 Unported License
*/

/**
 * The interface definition for a PureMVC Mediator.
 * 
 * @see org.puremvc.interfaces.INotification INotification
 */
interface IMediator
{
  
  /**
   * Get the <code>IMediator</code> instance name
   * 
   * @return the <code>IMediator</code> instance name
   */
  function getMediatorName();
  
  /**
   * Get the <code>IMediator</code>'s view component.
   * 
   * @return Object the view component
   */
  function getViewComponent();

  /**
   * Set the <code>IMediator</code>'s view component.
   * 
   * @param Object the view component
   */
  function setViewComponent( Object $viewComponent );
  
  /**
   * List <code>INotification</code> interests.
   * 
   * @return an <code>Array</code> of the <code>INotification</code> names this <code>IMediator</code> has an interest in.
   */
  function listNotificationInterests( );
  
  /**
   * Handle an <code>INotification</code>.
   * 
   * @param notification the <code>INotification</code> to be handled
   */
  function handleNotification( INotification $notification );
  
  /**
   * Called when the View registers a Mediator.
   */
  function onRegister( );
  
  /**
   * Called when the View removes a Mediator.
   */
  function onRemove( );
  
}
?>
