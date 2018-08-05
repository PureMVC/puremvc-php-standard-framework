<?php
namespace puremvc\php\demos\basic\view;
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
 * The ApplicationView class initializes the general view of the application
 * by loading a php template file used to generate a view.
 */
class ApplicationView
{
    /**
     * Reference to the selected view, for basic demo this is always "/index.php"
     */
    private $view;
    /**
     * The loaded template string (html)
     */
    private $viewTemplate;

    /**
     * Constructor
     * @param mixed $view
     */
    public function __construct($view)
    {
        $this->view = $view;

        $this->_initializeView();
    }

    /**
     * Initializes the view by loading the index.php template
     */
    private function _initializeView()
    {
        switch ($this->view) {
            default:
                $file = 'org/puremvc/php/demos/basic/view/templates/index_template.php';
                break;
        }

        if (!$file) {
            return;
        }

        $display = file_get_contents($file);

        if ($display) {
            $this->viewTemplate = $display;
        } else {
            $display            = 'Sorry, error creating page.';
            $this->viewTemplate = $display;
        }
    }

    /**
     * Public getter for the view template.
     */
    public function getViewTemplate()
    {
        return $this->viewTemplate;
    }
}
