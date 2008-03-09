<?php
/*
 PureMVC PHP Port by Asbjørn Sloth Tønnesen <asbjorn.tonnesen@puremvc.org>
 PureMVC - Copyright(c) 2006-08 Futurescale, Inc., Some rights reserved.
 Your reuse is governed by the Creative Commons Attribution 3.0 Unported License
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
  function execute( INotification $notification );
}
?>
