<?php
/**
 * PureMVC PHP Basic Demo
 * @author Omar Gonzalez :: omar@almerblank.com
 * @author Hasan Otuome :: hasan@almerblank.com
 *
 * Created on Sep 24, 2008
 * PureMVC - Copyright(c) 2006-2008 Futurescale, Inc., Some rights reserved.
 * Your reuse is governed by the Creative Commons Attribution 3.0 Unported License
 */
require_once 'org/puremvc/php/patterns/command/SimpleCommand.php';
require_once 'org/puremvc/php/interfaces/INotification.php';
require_once 'org/puremvc/php/demos/basic/model/proxy/ApplicationDataProxy.php';

/**
 * Starts the application model, for the basic demo
 * this command loads the CSS file selected on the index.php page.
 */
class StartModelCommand extends SimpleCommand
{
    /**
     * Override execute to add logic.  In the <code>StartModelCommand</code>
     * the ApplicationDataProxy is started and registered, and then
     * the selected CSS file is loaded.
     */
    public function execute(INotification $notification)
    {
        $view = $notification->getBody();
        $cssFileName = $notification->getType();

        $applicationDataProxy = new ApplicationDataProxy();
        $this->facade->registerProxy($applicationDataProxy);

        $applicationDataProxy->loadCSS($cssFileName);
    }
}
