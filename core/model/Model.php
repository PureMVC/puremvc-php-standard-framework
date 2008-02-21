<?php
/*
 PureMVC PHP Port by Asbjørn Sloth Tønnesen <asbjorn.tonnesen@puremvc.org>
 PureMVC - Copyright(c) 2006, 2007 FutureScale, Inc., Some rights reserved.
 Your reuse is governed by the Creative Commons Attribution 3.0 Unported License
*/

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
 * @package org.puremvc.php.core.model.Model
 * @see org.puremvc.patterns.proxy.Proxy Proxy
 * @see org.puremvc.interfaces.IProxy IProxy
 */
class Model implements IModel
{
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
  private function __construct( )
  {
    $this->instance = $this;
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
  protected function initializeModel(  )
  {
  }
      
  /**
   * <code>Model</code> Singleton Factory method.
   * 
   * @return the Singleton instance
   */
  public static function getInstance()
  {
    if ($this->instance == null) $this->instance = new Model( );
    return $this->instance;
  }

  /**
   * Register an <code>IProxy</code> with the <code>Model</code>.
   * 
   * @param proxy an <code>IProxy</code> to be held by the <code>Model</code>.
   */
  public function registerProxy( IProxy $proxy )
  {
    $this->proxyMap[ $proxy->getProxyName() ] = $proxy;
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
    unset($this->proxyMap[ $proxyName ]);
  }

  // Mapping of proxyNames to IProxy instances
  protected $proxyMap;

  // Singleton instance
  protected static $instance;

}
?>
