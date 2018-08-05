<?php
/**
 * PureMVC PHP Unit Tests
 * @author Omar Gonzalez :: omar@almerblank.com
 * @author Hasan Otuome :: hasan@almerblank.com 
 * 
 * Created on Sep 24, 2008
 * PureMVC - Copyright(c) 2006-2008 Futurescale, Inc., Some rights reserved.
 * Your reuse is governed by the Creative Commons Attribution 3.0 Unported License
 */
use puremvc\php\patterns\command\SimpleCommand;
use puremvc\php\interfaces\INotification;

/**
 * A SimpleCommand subclass used by ControllerTest.
 *
 * @see org.puremvc.php.core.controller.ControllerTest ControllerTest
 * @see org.puremvc.php.core.controller.ControllerTestVO ControllerTestVO
 */
class ControllerTestCommand2 extends SimpleCommand
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
	}

    /**
     * Fabricate a result by multiplying the input by 2 and adding to the existing result
     * <P>
     * This tests accumulation effect that would show if the command were executed more than once.
     *
     * @param INotification $note the note carrying the ControllerTestVO
     */
	public function execute( INotification $note )
	{
		$vo = $note->getBody();
		$vo->result = $vo->result + ( 2 * $vo->input );
	}
}

?>
