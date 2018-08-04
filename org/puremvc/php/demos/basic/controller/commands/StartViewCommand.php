<?php
namespace puremvc\php\demos\basic\controller\commands;
use puremvc\php\interfaces\INotification;
use puremvc\php\patterns\command\SimpleCommand;
use puremvc\php\demos\basic\view\ApplicationView;
use puremvc\php\demos\basic\view\ApplicationMediator;
/**
 * PureMVC PHP Basic Demo
 * @author Omar Gonzalez :: omar@almerblank.com
 * @author Hasan Otuome :: hasan@almerblank.com
 *
 * Created on Sep 24, 2008
 * PureMVC - Copyright(c) 2006-2008 Futurescale, Inc., Some rights reserved.
 * Your reuse is governed by the Creative Commons Attribution 3.0 Unported License
 */

/**
 * Starts the view class which initializes php/html templates.
 */
class StartViewCommand extends SimpleCommand
{
    /**
     * The <code>execute()</code> method is overridden in order
     * to add your application logic for this specific command.
     * @param INotification $notification
     */
    public function execute(INotification $notification)
    {
        $view = $notification->getBody();
        $this->facade->registerMediator(new ApplicationMediator(new ApplicationView($view)));
    }
}
