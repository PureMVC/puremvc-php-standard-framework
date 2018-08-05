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
use puremvc\php\patterns\proxy\Proxy;

/**
 * Used by ModelTest to test the PureMVC Model.
 */
class ModelTestProxy extends Proxy
{
	
	const NAME = 'ModelTestProxy';
	const ON_REGISTER_CALLED = 'onRegister Called';
	const ON_REMOVE_CALLED = 'onRemove Called';
	
	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct ( ModelTestProxy::NAME, '' );
	}
	/**
     * Called when the Model registers a Proxy.
     */
	public function onRegister()
	{
		$this->setData( ModelTestProxy::ON_REGISTER_CALLED );
	}
	/**
     * Called when the Model removes a Proxy.
     */
	public function onRemove()
	{
		$this->setData( ModelTestProxy::ON_REMOVE_CALLED );
	}
}

?>
