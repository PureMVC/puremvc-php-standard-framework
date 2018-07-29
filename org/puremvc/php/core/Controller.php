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
require_once 'org/puremvc/php/patterns/observer/Observer.php';
require_once 'org/puremvc/php/core/View.php';
require_once 'org/puremvc/php/interfaces/IController.php';
require_once 'org/puremvc/php/interfaces/INotification.php';

/**
 * A Singleton <code>IController</code> implementation.
 *
 * <P>
 * In PureMVC, the <code>Controller</code> class follows the
 * 'Command and Controller' strategy, and assumes these
 * responsibilities:
 * <UL>
 * <LI> Remembering which <code>ICommand</code>s
 * are intended to handle which <code>INotifications</code>.</LI>
 * <LI> Registering itself as an <code>IObserver</code> with
 * the <code>View</code> for each <code>INotification</code>
 * that it has an <code>ICommand</code> mapping for.</LI>
 * <LI> Creating a new instance of the proper <code>ICommand</code>
 * to handle a given <code>INotification</code> when notified by the <code>View</code>.</LI>
 * <LI> Calling the <code>ICommand</code>'s <code>execute</code>
 * method, passing in the <code>INotification</code>.</LI>
 * </UL>
 *
 * <P>
 * Your application must register <code>ICommands</code> with the
 * Controller.
 * <P>
 * The simplest way is to subclass </code>Facade</code>,
 * and use its <code>initializeController</code> method to add your
 * registrations.
 *
 * @see org.puremvc.core.View View
 * @see org.puremvc.php.patterns.observer.Observer Observer
 * @see org.puremvc.php.patterns.observer.Notification Notification
 * @see org.puremvc.php.patterns.command.SimpleCommand SimpleCommand
 * @see org.puremvc.php.patterns.command.MacroCommand MacroCommand
 */
class Controller implements IController
{
    // Local reference to View
    protected $view;

    // Mapping of Notification names to Command Class references
    protected $commandMap;

    // Singleton instance
    protected static $instance;

    /**
     * Constructor.
     *
     * <P>
     * This <code>IController</code> implementation is a Singleton,
     * so you should not call the constructor
     * directly, but instead call the static Singleton
     * Factory method <code>Controller.getInstance()</code>
     *
     * @throws Error Error if Singleton instance has already been constructed
     */
    private function __construct()
    {
        $this->commandMap = [];
        $this->initializeController();
    }

    /**
     * Initialize the Singleton <code>Controller</code> instance.
     *
     * <P>Called automatically by the constructor.</P>
     *
     * <P>Note that if you are using a subclass of <code>View</code>
     * in your application, you should <i>also</i> subclass <code>Controller</code>
     * and override the <code>initializeController</code> method in the
     * following way:</P>
     *
     * <listing>
     *		// ensure that the Controller is talking to my IView implementation
     *		override public function initializeController(  ) : void
     *		{
     *			view = MyView.getInstance();
     *		}
     * </listing>
     */
    protected function initializeController()
    {
        $this->view = View::getInstance();
    }

    /**
     * <code>Controller</code> Singleton Factory method.
     *
     * @return the Singleton instance of <code>Controller</code>
     */
    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * If an <code>ICommand</code> has previously been registered
     * to handle a the given <code>INotification</code>, then it is executed.
     *
     * @param note an <code>INotification</code>
     */
    public function executeCommand(INotification $note)
    {
        if (isset($this->commandMap[$note->getName()])) {
            $commandClassName = $this->commandMap[$note->getName()];
            $commandClassReflector = new ReflectionClass($commandClassName);

            $commandClassRef = $commandClassReflector->newInstance();
            $commandClassRef->execute($note);
        }
    }

    /**
     * Register a particular <code>ICommand</code> class as the handler
     * for a particular <code>INotification</code>.
     *
     * <P>
     * If an <code>ICommand</code> has already been registered to
     * handle <code>INotification</code>s with this name, it is no longer
     * used, the new <code>ICommand</code> is used instead.</P>
     *
     * @param notificationName the name of the <code>INotification</code>
     * @param commandClassRef the <code>Class</code> of the <code>ICommand</code>
     * @param mixed $notificationName
     * @param mixed $commandClassRef
     */
    public function registerCommand($notificationName, $commandClassRef)
    {
        if (!$this->hasCommand($notificationName)) {
            $this->view->registerObserver($notificationName, new Observer('executeCommand', $this));
        }
        $this->commandMap[$notificationName] = $commandClassRef;
    }

    /**
     * Check if a Command is registered for a given Notification
     *
     * @param string $notificationName
     * @return whether a Command is currently registered for the given <code>notificationName</code>.
     */
    public function hasCommand($notificationName)
    {
        return isset($this->commandMap[$notificationName]);
    }

    /**
     * Remove a previously registered <code>ICommand</code> to <code>INotification</code> mapping.
     *
     * @param notificationName the name of the <code>INotification</code> to remove the <code>ICommand</code> mapping for
     * @param mixed $notificationName
     */
    public function removeCommand($notificationName)
    {
        // if the Command is registered...
        if ($this->hasCommand($notificationName)) {
            // remove the observer
            $this->view->removeObserver($notificationName, $this);

            // remove the command
            $this->commandMap[$notificationName] = null;
        }
    }
}
