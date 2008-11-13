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
 
require_once 'org/puremvc/php/interfaces/IModel.php';
require_once 'org/puremvc/php/interfaces/IProxy.php';

/**
 * A Singleton <code>IModel</code> implementation.
 * 
 * <P>
 * In PureMVC, the <code>Model</code> class provides
 * access to model objects (Proxies) by named lookup. 
 * 
 * <P>
 * The <code>Model</code> assumes these responsibilities:</P>
 * 
 * <UL>
 * <LI>Maintain a cache of <code>IProxy</code> instances.</LI>
 * <LI>Provide methods for registering, retrieving, and removing 
 * <code>IProxy</code> instances.</LI>
 * </UL>
 * 
 * <P>
 * Your application must register <code>IProxy</code> instances 
 * with the <code>Model</code>. Typically, you use an 
 * <code>ICommand</code> to create and register <code>IProxy</code> 
 * instances once the <code>Facade</code> has initialized the Core 
 * actors.</p>
 *
 * @package org.puremvc.php.core.Model
 * @see org.puremvc.php.patterns.proxy.Proxy Proxy
 * @see org.puremvc.php.interfaces.IProxy IProxy
 */
class Model implements IModel
{
  // Mapping of proxyNames to IProxy instances
  protected $proxyMap;

  // Singleton instance
  protected static $instance;
  
  /**
   * Constructor. 
   * 
   * <P>
   * This <code>IModel</code> implementation is a Singleton, 
   * so you should not call the constructor 
   * directly, but instead call the static Singleton 
   * Factory method <code>Model.getInstance()</code>
   * 
   * @throws Error Error if Singleton instance has already been constructed
   * 
   */
  private function __construct()
  {
    $this->proxyMap = array();
    $this->initializeModel();	
  }
  /**
   * Initialize the Singleton <code>Model</code> instance.
   * 
   * <P>
   * Called automatically by the constructor, this
   * is your opportunity to initialize the Singleton
   * instance in your subclass without overriding the
   * constructor.</P>
   * 
   * @return void
   */
  protected function initializeModel()
  {
  }
      
  /**
   * <code>Model</code> Singleton Factory method.
   * 
   * @return the Singleton instance
   */
  static public function getInstance()
  {
    if (Model::$instance == null) Model::$instance = new Model();
    return Model::$instance;
  }

  /**
   * Register an <code>IProxy</code> with the <code>Model</code>.
   * 
   * @param proxy an <code>IProxy</code> to be held by the <code>Model</code>.
   */
  public function registerProxy( IProxy $proxy )
  {
    $this->proxyMap[ $proxy->getProxyName() ] = $proxy;
    $proxy->onRegister();
  }

  /**
   * Retrieve an <code>IProxy</code> from the <code>Model</code>.
   * 
   * @param proxyName
   * @return the <code>IProxy</code> instance previously registered with the given <code>proxyName</code>.
   */
  public function retrieveProxy( $proxyName )
  {
    return $this->proxyMap[ $proxyName ];
  }

 /**
   * Remove an <code>IProxy</code> from the <code>Model</code>.
   * 
   * @param proxyName name of the <code>IProxy</code> instance to be removed.
   */
  public function removeProxy( $proxyName )
  {
    // get a reference to the proxy to be removed 
    $proxy = $this->proxyMap[ $proxyName ];

    // remove the instance from the map
    unset($this->proxyMap[ $proxyName ]);

	// alert the proxy that it has been removed
    $proxy->onRemove();
    
    return $proxy;
  }

  /**
   * Check to see if a Proxy is registered with the Model.
   * 
   * @param proxyName name of the <code>IProxy</code> instance to check for.
   */
  public function hasProxy( $proxyName )
  {
  	return $this->proxyMap[ $proxyName ] != null;
  }
}
?>
