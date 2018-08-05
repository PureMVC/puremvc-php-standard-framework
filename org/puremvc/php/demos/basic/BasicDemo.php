<?php
namespace puremvc\php\demos\basic;
/**
 * PureMVC PHP Basic Demo
 * PureMVC Port to PHP originally translated by Asbjørn Sloth Tønnesen
 *
 * @author Omar Gonzalez :: omar@almerblank.com
 * @author Hasan Otuome :: hasan@almerblank.com
 *
 * Created on Sep 24, 2008
 * PureMVC - Copyright(c) 2006-2008 Futurescale, Inc., Some rights reserved.
 * Your reuse is governed by the Creative Commons Attribution 3.0 Unported License
 */

/**
 * PureMVC PHP Basic demo base class.  The index starts an
 * instance of the BasicDemo object to start the application
 * view calling the <code>startView()</code> method.
 */
class BasicDemo
{
    public function __construct()
    {
    }

    /**
     * Starts the PureMVC framework passing in variables
     * from the index.php
     * @param mixed $filename
     * @param mixed $cssName
     */
    public function startView($filename, $cssName)
    {
        $facade = ApplicationFacade::getInstance();
        $facade->startUp($filename, $cssName);
    }
}
