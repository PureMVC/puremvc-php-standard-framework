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
 
require_once 'org/puremvc/php/interfaces/ICommand.php'; 
require_once 'org/puremvc/php/interfaces/INotifier.php'; 
require_once 'org/puremvc/php/patterns/observer/Notifier.php'; 
require_once 'org/puremvc/php/patterns/facade/Facade.php';

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
	protected $facade;
	
	public function __construct()
	{
		$this->facade = Facade::getInstance();
	}
    
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
