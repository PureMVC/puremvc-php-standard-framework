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

require_once 'org/puremvc/php/interfaces/IProxy.php'; 
require_once 'org/puremvc/php/interfaces/INotifier.php'; 
require_once 'org/puremvc/php/patterns/observer/Notifier.php'; 
require_once 'org/puremvc/php/patterns/facade/Facade.php';

/**
 * A base <code>IProxy</code> implementation. 
 * 
 * <P>
 * In PureMVC, <code>Proxy</code> classes are used to manage parts of the 
 * application's data model. </P>
 * 
 * <P>
 * A <code>Proxy</code> might simply manage a reference to a local data object, 
 * in which case interacting with it might involve setting and 
 * getting of its data in synchronous fashion.</P>
 * 
 * <P>
 * <code>Proxy</code> classes are also used to encapsulate the application's 
 * interaction with remote services to save or retrieve data, in which case, 
 * we adopt an asyncronous idiom; setting data (or calling a method) on the 
 * <code>Proxy</code> and listening for a <code>Notification</code> to be sent 
 * when the <code>Proxy</code> has retrieved the data from the service. </P>
 * 
 * @see org.puremvc.core.model.Model Model
 */
 
class Proxy extends Notifier implements IProxy, INotifier
{

  // the proxy name
  protected $proxyName;
  
  // the data object
  protected $data;
  
  protected $facade;

  const NAME = 'Proxy';
  
  /**
   * Constructor
   */
  public function __construct( $proxyName=null, $data=null ) 
  {
  	$this->facade = Facade::getInstance();
    $this->proxyName = ($proxyName != null) ? $proxyName : self::NAME; 
    if ($data != null) $this->setData($data);
  }

  /**
   * Get the proxy name
   */
  public function getProxyName() 
  {
    return $this->proxyName;
  }		
  
  /**
   * Set the data object
   */
  public function setData( $data ) 
  {
    $this->data = $data;
  }
  
  /**
   * Get the data object
   */
  public function getData() 
  {
    return $this->data;
  }		
  
  /**
   * Called when the Model registers a Proxy.
   */
  public function onRegister()
  {
     return;
  }
  
  /**
   * Called when the Model removes a Proxy.
   */
  public function onRemove()
  {
     return;
  }
}
?>
