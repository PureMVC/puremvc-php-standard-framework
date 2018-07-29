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
require_once 'org/puremvc/php/core/Controller.php';
require_once 'org/puremvc/php/core/Model.php';
require_once 'org/puremvc/php/core/View.php';
require_once 'org/puremvc/php/interfaces/IFacade.php';
require_once 'org/puremvc/php/interfaces/IMediator.php';
require_once 'org/puremvc/php/interfaces/INotification.php';
require_once 'org/puremvc/php/interfaces/IProxy.php';
require_once 'org/puremvc/php/patterns/observer/Notification.php';

/**
 * A base Singleton <code>IFacade</code> implementation.
 * 
 * <P>
 * In PureMVC, the <code>Facade</code> class assumes these 
 * responsibilities:
 * <UL>
 * <LI>Initializing the <code>Model</code>, <code>View</code>
 * and <code>Controller</code> Singletons.</LI> 
 * <LI>Providing all the methods defined by the <code>IModel, 
 * IView, & IController</code> interfaces.</LI>
 * <LI>Providing the ability to override the specific <code>Model</code>,
 * <code>View</code> and <code>Controller</code> Singletons created.</LI> 
 * <LI>Providing a single point of contact to the application for 
 * registering <code>Commands</code> and notifying <code>Observers</code></LI>
 * </UL>
 * 
 * @see org.puremvc.php.core.Model Model
 * @see org.puremvc.php.core.View View
 * @see org.puremvc.php.core.Controller Controller
 * @see org.puremvc.php.patterns.observer.Notification Notification
 * @see org.puremvc.php.patterns.mediator.Mediator Mediator
 * @see org.puremvc.php.patterns.proxy.Proxy Proxy
 * @see org.puremvc.php.patterns.command.SimpleCommand SimpleCommand
 * @see org.puremvc.php.patterns.command.MacroCommand MacroCommand
 */
class Facade implements IFacade
{
    // Private references to Model, View and Controller
    protected $controller;
    protected $model;
    protected $view;

    // The Singleton Facade instance.
    protected static $instance;

    /**
     * Constructor. 
     * 
     * <P>
     * This <code>IFacade</code> implementation is a Singleton, 
     * so you should not call the constructor 
     * directly, but instead call the static Singleton 
     * Factory method <code>Facade.getInstance()</code>
     * 
     * @throws Error Error if Singleton instance has already been constructed
     */
    protected function __construct()
    {
        $this->initializeFacade();
    }

    /**
     * Initialize the Singleton <code>Facade</code> instance.
     * 
     * <P>
     * Called automatically by the constructor. Override in your
     * subclass to do any subclass specific initializations. Be
     * sure to call <code>super.initializeFacade()</code>, though.</P>
     */
    protected function initializeFacade()
    {
        $this->initializeModel();
        $this->initializeController();
        $this->initializeView();
    }

    /**
     * Facade Singleton Factory method
     * 
     * @return the Singleton instance of the Facade
     */
    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Initialize the <code>Controller</code>.
     * 
     * <P>
     * Called by the <code>initializeFacade</code> method.
     * Override this method in your subclass of <code>Facade</code> 
     * if one or both of the following are true:
     * <UL>
     * <LI> You wish to initialize a different <code>IController</code>.</LI>
     * <LI> You have <code>Commands</code> to register with the <code>Controller</code> at startup.</code>. </LI>		  
     * </UL>
     * If you don't want to initialize a different <code>IController</code>, 
     * call <code>super.initializeController()</code> at the beginning of your
     * method, then register <code>Command</code>s.
     * </P>
     */
    protected function initializeController()
    {
        if (null !== $this->controller) {
            return;
        }
        $this->controller = Controller::getInstance();
    }

    /**
     * Initialize the <code>Model</code>.
     * 
     * <P>
     * Called by the <code>initializeFacade</code> method.
     * Override this method in your subclass of <code>Facade</code> 
     * if one or both of the following are true:
     * <UL>
     * <LI> You wish to initialize a different <code>IModel</code>.</LI>
     * <LI> You have <code>Proxy</code>s to register with the Model that do not 
     * retrieve a reference to the Facade at construction time.</code></LI> 
     * </UL>
     * If you don't want to initialize a different <code>IModel</code>, 
     * call <code>super.initializeModel()</code> at the beginning of your
     * method, then register <code>Proxy</code>s.
     * <P>
     * Note: This method is <i>rarely</i> overridden; in practice you are more
     * likely to use a <code>Command</code> to create and register <code>Proxy</code>s
     * with the <code>Model</code>, since <code>Proxy</code>s with mutable data will likely
     * need to send <code>INotification</code>s and thus will likely want to fetch a reference to 
     * the <code>Facade</code> during their construction. 
     * </P>
     */
    protected function initializeModel()
    {
        if (null !== $this->model) {
            return;
        }
        $this->model = Model::getInstance();
    }

    /**
     * Initialize the <code>View</code>.
     * 
     * <P>
     * Called by the <code>initializeFacade</code> method.
     * Override this method in your subclass of <code>Facade</code> 
     * if one or both of the following are true:
     * <UL>
     * <LI> You wish to initialize a different <code>IView</code>.</LI>
     * <LI> You have <code>Observers</code> to register with the <code>View</code></LI>
     * </UL>
     * If you don't want to initialize a different <code>IView</code>, 
     * call <code>super.initializeView()</code> at the beginning of your
     * method, then register <code>IMediator</code> instances.
     * <P>
     * Note: This method is <i>rarely</i> overridden; in practice you are more
     * likely to use a <code>Command</code> to create and register <code>Mediator</code>s
     * with the <code>View</code>, since <code>IMediator</code> instances will need to send 
     * <code>INotification</code>s and thus will likely want to fetch a reference 
     * to the <code>Facade</code> during their construction. 
     * </P>
     */
    protected function initializeView()
    {
        if (null !== $this->view) {
            return;
        }
        $this->view = View::getInstance();
    }

    /**
     * Notify <code>Observer</code>s.
     * 
     * @param notification the <code>INotification</code> to have the <code>View</code> notify <code>Observers</code> of.
     */
    public function notifyObservers(INotification $notification)
    {
        if (null !== $this->view) {
            $this->view->notifyObservers($notification);
        }
    }

    /**
     * Register an <code>ICommand</code> with the <code>Controller</code> by Notification name.
     * 
     * @param notificationName the name of the <code>INotification</code> to associate the <code>ICommand</code> with
     * @param commandClassRef a reference to the Class of the <code>ICommand</code>
     * @param mixed $notificationName
     * @param mixed $commandClassRef
     */
    public function registerCommand($notificationName, $commandClassRef)
    {
        $this->controller->registerCommand($notificationName, $commandClassRef);
    }

    /**
     * Remove a previously registered <code>ICommand</code> to <code>INotification</code> mapping from the Controller.
     * 
     * @param notificationName the name of the <code>INotification</code> to remove the <code>ICommand</code> mapping for
     * @param mixed $notificationName
     */
    public function removeCommand($notificationName)
    {
        $this->controller->removeCommand($notificationName);
    }

    /**
     * Check if a Command is registered for a given Notification 
     * 
     * @param notificationName
     * @param mixed $notificationName
     * @return whether a Command is currently registered for the given <code>notificationName</code>.
     */
    public function hasCommand($notificationName)
    {
        return $this->controller->hasCommand($notificationName);
    }

    /**
     * Register an <code>IProxy</code> with the <code>Model</code> by name.
     * 
     * @param proxyName the name of the <code>IProxy</code>.
     * @param proxy the <code>IProxy</code> instance to be registered with the <code>Model</code>.
     */
    public function registerProxy(IProxy $proxy)
    {
        $this->model->registerProxy($proxy);
    }

    /**
     * Retrieve an <code>IProxy</code> from the <code>Model</code> by name.
     * 
     * @param proxyName the name of the proxy to be retrieved.
     * @param mixed $proxyName
     * @return the <code>IProxy</code> instance previously registered with the given <code>proxyName</code>.
     */
    public function retrieveProxy($proxyName)
    {
        return $this->model->retrieveProxy($proxyName);
    }

    /**
     * Check to see if a Proxy is registered with the Model.
     * 
     * @param proxyName name of the <code>IProxy</code> instance to check for.
     * @param mixed $proxyName
     */
    public function hasProxy($proxyName)
    {
        return $this->model->hasProxy($proxyName);
    }

    /**
     * Remove an <code>IProxy</code> from the <code>Model</code> by name.
     *
     * @param proxyName the <code>IProxy</code> to remove from the <code>Model</code>.
     * @param mixed $proxyName
     */
    public function removeProxy($proxyName)
    {
        if (null !== $this->model) {
            $proxy = $this->model->removeProxy($proxyName);
        }

        return $proxy;
    }

    /**
     * Register a <code>IMediator</code> with the <code>View</code>.
     * 
     * @param mediatorName the name to associate with this <code>IMediator</code>
     * @param mediator a reference to the <code>IMediator</code>
     */
    public function registerMediator(IMediator $mediator)
    {
        if (null !== $this->view) {
            $this->view->registerMediator($mediator);
        }
    }

    /**
     * Retrieve an <code>IMediator</code> from the <code>View</code>.
     * 
     * @param mediatorName
     * @param mixed $mediatorName
     * @return the <code>IMediator</code> previously registered with the given <code>mediatorName</code>.
     */
    public function retrieveMediator($mediatorName)
    {
        return $this->view->retrieveMediator($mediatorName);
    }

    /**
     * Check to see if a Mediator is registered with the View.
     * 
     * @param mediatorName name of the <code>IMediator</code> instance to check for.
     * @param mixed $mediatorName
     */
    public function hasMediator($mediatorName)
    {
        return $this->view->hasMediator($mediatorName);
    }

    /**
     * Remove an <code>IMediator</code> from the <code>View</code>.
     * 
     * @param mediatorName name of the <code>IMediator</code> to be removed.
     * @param mixed $mediatorName
     */
    public function removeMediator($mediatorName)
    {
        if (null !== $this->view) {
            $mediator = $this->view->removeMediator($mediatorName);
        }

        return $mediator;
    }

    /**
     * Send an <code>INotification</code>.
     * 
     * <P>
     * Keeps us from having to construct new notification 
     * instances in our implementation code.
     * @param notificationName the name of the notiification to send
     * @param body the body of the notification (optional)
     * @param type the type of the notification (optional)
     * @param mixed $notificationName
     * @param null|mixed $body
     * @param null|mixed $type
     */
    public function sendNotification($notificationName, $body = null, $type = null)
    {
        $this->notifyObservers(new Notification($notificationName, $body, $type));
    }
}
