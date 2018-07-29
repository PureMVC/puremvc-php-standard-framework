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
require_once 'org/puremvc/php/patterns/proxy/Proxy.php';
require_once 'org/puremvc/php/demos/basic/model/vo/ApplicationDataVO.php';
require_once 'org/puremvc/php/demos/basic/ApplicationFacade.php';

/**
 * The ApplicationDataProxy manipulates the ApplicationDataVO which
 * contains all of the general application data.
 */
class ApplicationDataProxy extends Proxy
{
    const NAME = 'ApplicationDataProxy';

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct(self::NAME, new ApplicationDataVO());
    }

    /**
     * Loads a CSS file selected from the index.php page and
     * sends a notification when the data is complete.
     * @param mixed $cssFileName
     */
    public function loadCSS($cssFileName)
    {
        $this->getApplicationDataVO()->viewData = [];
        $this->getApplicationDataVO()->viewData['css'] = $this->_getViewCSS($cssFileName);
        $this->sendNotification(ApplicationFacade::VIEW_DATA_READY, $this->getApplicationDataVO()->viewData);
    }

    /**
     * Does the actual file loading of the CSS file.
     *
     * @param mixed $cssName
     * @return A String value of the CSS loaded.
     */
    private function _getViewCSS($cssName)
    {
        $cssPath = "org/puremvc/php/demos/basic/view/templates/css/$cssName.css";

        $contents = file_get_contents($cssPath);

        return $contents;
    }

    /**
     * Public getter for <code>ApplicationDataVO</code>
     *
     * @return The instance of ApplicationDataVO
     */
    public function getApplicationDataVO()
    {
        return $this->getData();
    }
}
