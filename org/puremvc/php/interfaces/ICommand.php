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
 * The interface definition for a PureMVC Command.
 *
 * @see org.puremvc.php.interfaces INotification
 */
interface ICommand
{
  /**
   * Execute the <code>ICommand</code>'s logic to handle a given <code>INotification</code>.
   * 
   * @param note an <code>INotification</code> to handle.
   */
  public function execute( INotification $notification );
}
?>
