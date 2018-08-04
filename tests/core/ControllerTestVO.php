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
/**
 * A utility class used by ControllerTest.
 * 
 * @see org.puremvc.php.core.controller.ControllerTest ControllerTest
 * @see org.puremvc.php.core.controller.ControllerTestCommand ControllerTestCommand
 */
class ControllerTestVO
{	
	public $input;
	public $result;

    /**
     * Constructor
     * @param $testValue
     */
	public function __construct( $testValue )
	{
		$this->input = $testValue;	
	}
}

?>
