<?php
/*
 PureMVC PHP Port by Asbjørn Sloth Tønnesen <asbjorn.tonnesen@puremvc.org>
 PureMVC - Copyright(c) 2006, 2007 FutureScale, Inc., Some rights reserved.
 Your reuse is governed by the Creative Commons Attribution 3.0 Unported License
*/

/**
 * A base <code>ICommand</code> implementation.
 * 
 * <P>
 * Your subclass should override the <code>execute</code> 
 * method where your business logic will handle the <code>INotification</code>. </P>
 * 
 * @see org.puremvc.core.controller.Controller Controller
 * @see org.puremvc.patterns.observer.Notification Notification
 * @see org.puremvc.patterns.command.MacroCommand MacroCommand
 */
class SimpleCommand extends Notifier implements ICommand, INotifier 
{
  
  /**
   * Fulfill the use-case initiated by the given <code>INotification</code>.
   * 
   * <P>
   * In the Command Pattern, an application use-case typically
   * begins with some user action, which results in an <code>INotification</code> being broadcast, which 
   * is handled by business logic in the <code>execute</code> method of an
   * <code>ICommand</code>.</P>
   * 
   * @param notification the <code>INotification</code> to handle.
   */
  public function execute( INotification $notification )
  {
    
  }
              
}
?>
